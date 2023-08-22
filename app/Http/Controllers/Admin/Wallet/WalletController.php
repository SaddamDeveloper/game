<?php

namespace App\Http\Controllers\Admin\Wallet;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Models\WalletHistory;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index()
    {
        return view('admin.wallet.index');
    }

    public function walletList()
    {
        return datatables()->of(Wallet::get())
            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                return isset($row->user->name) ? $row->user->name : '';
            })
            ->addColumn('mobile', function ($row) {
                return isset($row->user->mobile) ? $row->user->mobile : '';
            })
            ->editColumn('balance', function ($row) {
                return number_format($row->amount, 2);
            })
            ->addColumn('action', function ($row) {
                $btn = '<a href="'.route('admin.wallet_history', ['id'=>encrypt($row->id)]).'" class="btn btn-warning btn-sm" target="_blank">View History</a>';
                return $btn;
            })
            ->rawColumns(['name', 'mobile', 'balance', 'action'])
            ->make(true);
    }

    public function walletHistory($id){
        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            abort(404);
        }
        $wallet_history = WalletHistory::where('wallet_id', $id)->latest()->paginate(20);
        return view('admin.wallet.history', compact('wallet_history'));
    }
}
