<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankCard;
use App\Models\Complaint;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPlayGame;
use App\Models\Wallet;
use App\Models\WalletHistory;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function userList(Request $request)
    {
        return view('admin.users.user_list');
    }

    public function userListAjax(Request $request)
    {
        return datatables()->of(User::get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn ='<a href="'.route('admin.user.edit', $row).'" class="btn btn-warning btn-sm" target="_blank">Edit</a>';
                if ($row->status == '1') {
                    $btn .='<a href="'.route('admin.user.status', $row).'" class="btn btn-danger btn-sm" >Disable</a>';
                } else {
                    $btn .='<a href="'.route('admin.user.status', $row).'" class="btn btn-primary btn-sm" >Enable</a>';
                }                
                return $btn;
            })->addColumn('user_gender', function($row){
                if ($row->gender == 'M'){
                    return 'Male';
                } else {
                    return 'Female';
                }
            })
            ->rawColumns(['action','user_gender'])
            ->make(true);
    }
    public function edit($id){
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }
    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->mobile  = $request->input('mobile');
        $user->state  = $request->input('state');
        $user->city  = $request->input('city');
        $user->pin  = $request->input('pin');
        $user->address  = $request->input('address');
        if ($user->save()) {
            return redirect()->back()->with('message', 'User Updated Successfully!');
        }else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function status(User $user){
        $user->status == 1 ? $user->status = 2 : $user->status = 1;
        if($user->save()){
        return redirect()->back()->with('message', 'User Updated Successfully!');
        }else {
        return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function gameplay(){
        return view('admin.users.gameplay');
    }

    public function gameplayList(){
        return datatables()->of(UserPlayGame::get())
            ->addIndexColumn()
            ->addColumn('name', function($row){
               return isset($row->user->name) ? $row->user->name : '';
            })
            ->addColumn('mobile', function($row){
               return isset($row->user->mobile) ? $row->user->mobile : '';
            })
            ->addColumn('period', function($row){
               return $row->game_play_id;
            })
            ->addColumn('amount', function($row){
               return number_format($row->amount, 2);
            })
            ->addColumn('date', function($row){
               return $row->created_at;
            })
            ->rawColumns(['name','mobile', 'period', 'amount', 'date'])
            ->make(true);
    }

    public function order(){
        return view('admin.users.user_orders');
    }

    public function orderList(){
        return datatables()->of(Order::get())
            ->addIndexColumn()
            ->addColumn('name', function($row){
               return isset($row->user->name) ? $row->user->name : '';
            })
            ->addColumn('mobile', function($row){
               return isset($row->user->mobile) ? $row->user->mobile : '';
            })
            ->addColumn('amount', function($row){
               return number_format($row->amount, 2);
            })
            ->addColumn('payment_id', function($row){
               return $row->razorpay_payment_id;
            })
            ->rawColumns(['name','mobile', 'amount', 'payment_id'])
            ->make(true);
    }

    public function request(){
        return view('admin.users.request');
    }

    public function requestList(){
        return datatables()->of(Withdrawal::get())
            ->addIndexColumn()
            ->addColumn('name', function($row){
               return isset($row->user->name) ? $row->user->name : '';
            })
            ->addColumn('mobile', function($row){
               return isset($row->user->mobile) ? $row->user->mobile : '';
            })
            ->addColumn('amount', function($row){
               return number_format($row->amount, 2);
            })
            ->addColumn('action', function($row){
                $wallet_balance = Wallet::where('user_id', $row->user_id)->first();
                if($row->status == 1){
                    $btn = '<div id="btn-grp"><button data-toggle="modal" data-target="#exampleModal" id="btn-approve" class="btn btn-primary" data-wdr-id = "'.$row->id.'" data-status-id = "2" data-wallet_balance = "'.number_format($wallet_balance->amount, 2).'" data-request-amount = "'.number_format($row->amount, 2).'" data-title="Approve">Approve</button>
                    <button data-toggle="modal" data-target="#exampleModal" id="btn-approve" class="btn btn-danger" data-wdr-id = "'.$row->id.'" data-wallet_balance = "'.number_format($wallet_balance->amount, 2).'" data-request-amount = "'.number_format($row->amount, 2).'" data-status-id = "3" data-title="Reject">Reject</button></div>';
                }else if($row->status == 2) {
                    $btn = '<button id="btn-approve" class="btn btn-primary" disabled>Approved</button>';
                }else{
                    $btn = '<button id="btn-approve" class="btn btn-danger" disabled>Rejected</button>';
                }
                $btn .='<a target="_blank" href="'.route('admin.users.account_info',['id' => encrypt($row->bankCard->id)]).'" class="btn btn-warning">View Account Info</a>';
               return $btn;
            })
            ->rawColumns(['name','mobile', 'amount', 'action'])
            ->make(true);
    }

    public function requestUpdate(Request $request){
        $this->validate($request, [
            'wdrId' => 'required',
            'status' => 'required|numeric'
        ]);
        
        $wdr_id = $request->input('wdrId');
        $status = $request->input('status');
        $comment= $request->input('comment');
        // 
        $withdrawals = Withdrawal::find($wdr_id);
        // Check User Wallet is fine or not
            $withdrawals->status  = $status;
            $withdrawals->comment= $comment;
            if($status == 2 && $withdrawals->save()){
                return response()->json(['msg' => '1']);
            }elseif($status == 3){
                try {
                    DB::transaction(function () use ($withdrawals){
                        // revert back to wallet and wallet history
                        $wallet = Wallet::where('user_id', $withdrawals->user_id)->first();
                        $wallet->amount = ($wallet->amount) + ($withdrawals->amount);
                        $wallet->save();
                        $wallet_history = new WalletHistory();
                        $wallet_history->wallet_id = $wallet->id;
                        $wallet_history->comment = "Rs ".$withdrawals->amount ." has been revert back to yopur account due to rejection of withdrawals";
                        $wallet_history->amount = $withdrawals->amount;
                        $wallet_history->total = $wallet->amount;
                        $wallet_history->status = 1;
                        $wallet_history->save();
                        $withdrawals->save();
                    });
                    return response()->json(['msg' => '2']);
                } catch (\Exception $e) {
                    dd($e);
                    return response()->json(['err' => 'Something went wrong!']);
                }
            }
    }

    public function userInfo($id){
        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            abort(404);
        }
        $account = BankCard::find($id);
        return view('admin.users.account_info', compact('account'));
    }

    public function complaint(){
        return view('admin.users.complaint');
    }

    public function getComplaint(){
        return datatables()->of(Complaint::get())
            ->addIndexColumn()
            ->addColumn('name', function($row){
               return isset($row->user->name) ? $row->user->name : '';
            })
            ->addColumn('mobile', function($row){
               return $row->mobile;
            })
            ->rawColumns(['name','mobile'])
            ->make(true);
    }
}
