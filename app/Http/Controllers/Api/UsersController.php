<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ParityRecordsResource;
use App\Models\BankCard;
use App\Models\Order;
use Illuminate\Http\Request;
use Str;
use App\Models\User;
use App\Models\UserPlayGame;
use App\Models\Wallet;
use App\Models\WalletHistory;
use App\Models\Complaint;
use App\Models\Withdrawal;
use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function login(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'mobile' => 'required|numeric',
            'password' => 'required|bail|min:6',
        ]);
        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => 'Required Field Can not be Empty',
                'error_code' => true,
                'error_message' => $validator->errors(),
            ];
            return response()->json($response, 200);
        }

        $credentials = request(['mobile', 'password']);
        if (!Auth::attempt($credentials)) {
            $response = [
                'status' => false,
                'msg' => 'Unauthorized'
            ];
            return response()->json($response, 200);
        }

        $user = User::where('mobile', $request->mobile)->first();
        $token = $user->createToken('auth-token')->plainTextToken;
        $response = [
            'status' => true,
            'user' => $user,
            'token' => $token
        ];
        return response()->json($response, 200);
    }

    public function sendOtp(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'required|numeric|digits:10'
        ]);
        if ($request->input('type') == 1) {
            $userCount = User::whereMobile($request->input('mobile'))->where(function ($q) {
                $q->where('status', 2);
            })->count();
            if ($userCount > 0) {
                return response()->json(['msg' => 'ALREADY_REGD']);
            }
        }
        // OTP Integration
        // $random = mt_rand(100000, 999999);
        $random = 1111;
        // $otp_code = $this->otp($random, $request->input('mobile'));
        $user = User::firstOrCreate([
            'mobile' => $request->input('mobile')
        ]);
        if ($user) {
            $user->otp = $random;
            $user->save();
            return response()->json([
                'msg' => 'SUCCESS'
            ]);
        }
    }

    public function userRegisteration(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'otp' => 'required|numeric|min:6|exists:user,otp',
            'password' => ['required', 'string', 'min:6', 'same:confirm_password'],
        ]);
        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => 'Required Field Can not be Empty',
                'error_code' => true,
                'error_message' => $validator->errors(),
            ];
            return response()->json($response, 200);
        }
        $userCount = User::whereMobile($request->input('mobile'))->whereStatus(2)->count();
        if ($userCount > 0) {
            return response()->json(['msg' => 'ALREADY_REGD']);
        }
        $user = User::whereMobile($request->input('mobile'))->first();
        $ref = $request->input('refferal');
        $referrer = null;
        if (!empty($ref)) {
            $referrer = User::whereUsername($ref);
            if ($referrer->count() == 0) {
                return response()->json(['msg' => 'Referral ID is invalid']);
            }
        }
        try {
            DB::transaction(function () use ($request, $referrer, $user) {
                if (!empty($referrer)) {
                    $referrer = $referrer->first();
                }
                $user->password = Hash::make($request->input('password'));
                $user->referrer_id  = $referrer ? $referrer->id : null;
                $user->status = 2;
                if ($referrer) {
                    $user->refferal_status = 2;
                }
                $user->save();
                $user->username = str_pad($user->id, 5, mt_rand(00000, 99999), STR_PAD_LEFT);
                $user->save();
                $user_wallet = new Wallet();
                $user_wallet->user_id = $user->id;
                $user_wallet->amount = $referrer ? ($user_wallet->amount + 50) : ($user_wallet->amount + 0);
                $user_wallet->save();
                $wallet_history = new WalletHistory();
                $wallet_history->wallet_id = $user_wallet->id;
                $wallet_history->comment  = "Welcome Gift";
                $wallet_history->amount = $referrer ? $user_wallet->amount : 0;
                $wallet_history->total = $referrer ? $user_wallet->amount : 0;
                $wallet_history->save();
            });
            $response = [
                'status' => true,
                'message' => 'User Registered Successfully',
                'error_code' => false,
                'error_message' => null,
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['msg' => 'Something went wrong!']);
        }
    }

    public function userLogin(Request $request)
    {
        $user_id = $request->input('user_id');
        $user_pass = $request->input('password');
        if (!empty($user_id) && !empty($user_pass)) {
            $user = User::where('mobile', $user_id)->orWhere('email', $user_id)->first();
            if ($user) {
                if (Hash::check($user_pass, $user->password)) {
                    $user_update = User::where('id', $user->id)
                        ->update([
                            'api_token' => Str::random(60),
                        ]);
                    $response = [
                        'status' => true,
                        'message' => 'User Logged In Successfully',
                        'data' => User::find($user->id),
                    ];
                    return response()->json($response, 200);
                } else {
                    $response = [
                        'status' => false,
                        'message' => 'User Id  or password Wrong',
                        'data' => null,
                    ];
                    return response()->json($response, 200);
                }
            } else {
                $response = [
                    'status' => false,
                    'message' => 'User Id or password Wrong',
                    'data' => null,
                ];
                return response()->json($response, 200);
            }
        } else {
            $response = [
                'status' => false,
                'message' => 'Required Field Can Not be Empty',
                'data' => null,
            ];
            return response()->json($response, 200);
        }
    }

    public function userProfile($user_id)
    {
        $user = User::find($user_id);
        if ($user) {
            $response = [
                'status' => true,
                'message' => 'User Profile',
                'data' => $user,
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'status' => false,
                'message' => 'User Not Found',
                'data' => null,
            ];
            return response()->json($response, 200);
        }
    }

    public function userProfileUpdate(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'dob' => 'required',
            'gender' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pin' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => 'Required Field Can not be Empty',
                'error_code' => true,
                'error_message' => $validator->errors(),
            ];
            return response()->json($response, 200);
        }
        $user_id = $request->input('user_id');
        $user_update = User::find($user_id);
        $user_update->name = $request->input('name');
        $user_update->dob = $request->input('dob');
        $user_update->gender = strtoupper($request->input('gender'));
        $user_update->state = $request->input('state');
        $user_update->city = $request->input('city');
        $user_update->pin = $request->input('pin');
        if ($user_update->save()) {
            $response = [
                'status' => true,
                'message' => 'Profile Updated Successfully',
                'error_code' => false,
                'error_message' => null,
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong Please Try Again',
                'error_code' => false,
                'error_message' => null,
            ];
            return response()->json($response, 200);
        }
    }

    public function userChangePassword(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'user_id' => 'required',
            'current_pass' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8', 'same:confirm_password'],
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => 'Required Field Can not be Empty',
                'error_code' => true,
                'error_message' => $validator->errors(),
            ];
            return response()->json($response, 200);
        }

        $user = User::find($request->input('user_id'));
        if ($user) {
            if (Hash::check($request->input('current_pass'), $user->password)) {
                $user->password = Hash::make($request->input('confirm_password'));

                if ($user->save()) {
                    $response = [
                        'status' => true,
                        'message' => 'Password Changed Successfully',
                        'error_code' => false,
                        'error_message' => null,
                    ];
                    return response()->json($response, 200);
                } else {
                    $response = [
                        'status' => false,
                        'message' => 'Something Went Wrong Please Try Again',
                        'error_code' => false,
                        'error_message' => null,
                    ];
                    return response()->json($response, 200);
                }
            } else {
                $response = [
                    'status' => false,
                    'message' => 'Please Enter Correct Corrent Password',
                    'error_code' => false,
                    'error_message' => null,
                ];
                return response()->json($response, 200);
            }
        } else {
            $response = [
                'status' => false,
                'message' => 'User Not Found Please Try Again',
                'error_code' => false,
                'error_message' => null,
            ];
            return response()->json($response, 200);
        }
    }

    public function logout(Request $request)
    {
        if ($request->user()->currentAccessToken()->delete()) {
            $response = [
                'status' => true,
                'msg' => 'Token Deleted'
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'status' => false,
                'msg' => 'Something Went Wrong!'
            ];
            return response()->json($response, 200);
        }
    }
    public function userDetails(Request $request)
    {

        $users = $request->user();
        $users->wallet;
        return response()->json([
            'status' => true,
            'users' => $users,
        ], 200);
    }
    public function parityRecords(Request $request, $gameId)
    {
        $user = $request->user();
        $records =  UserPlayGame::latest()->where('user_id', $user->id)->paginate(15);
        $response = [
            'status' => true,
            'data' => ParityRecordsResource::collection($records)
        ];
        return response()->json($response, 200);
    }
    public function transaction(Request $request)
    {
        $user = $request->user();
        $transaction = Order::latest()->where('user_id', $user->id)->limit(20)->get();
        return response()->json([
            'status' => true,
            'success_code' => 'SUCCESS',
            'data' => $transaction
        ], 200);
    }

    public function withdrawal()
    {
        $withdrawals = Withdrawal::latest()->where('user_id', Auth::user()->id)->limit(20)->get();
        return response()->json([
            'status' => true,
            'success_code' => 'SUCCESS',
            'data' => $withdrawals
        ], 200);
    }
    public function addWithdrawal(Request $request)
    {
        $this->validate($request, [
            'account'   => 'required|numeric',
            'amount' => 'required|numeric'
        ]);
        $user = User::find($request->user()->id);
        if ($user->wallet->amount < $request->input('amount')) {
            return response()->json([
                'msg' => 'Wallet balance is low',
                'error_code' => 'LOW_BAL'
            ], 200);
        }
        if ($request->input('amount') < 100) {
            return response()->json([
                'msg' => 'Minimum withdrawal amount is 100',
                'error_code' => 'MINIMUM'
            ], 200);
        }
        try {
            DB::transaction(function () use ($request) {
                $withdrawals = new Withdrawal();
                $withdrawals->user_id = $request->user()->id;
                $withdrawals->amount = $request->input('amount');
                $withdrawals->account = $request->input('account');
                $wallet = Wallet::where('user_id', $request->user()->id)->first();
                $wallet->amount = ($wallet->amount) - ($request->input('amount'));
                $wallet->save();
                $wallet_history = new WalletHistory();
                $wallet_history->wallet_id = $wallet->id;
                $wallet_history->comment  = "Rs " . $request->input('amount') . " has been deducted from your account for withdraw request!";
                $wallet_history->amount = $request->input('amount');
                $wallet_history->total = $wallet->amount;
                $wallet_history->status = 2;
                $wallet_history->save();
                $withdrawals->save();
            });
            return response()->json([
                'status' => true,
                'msg' => 'Success',
                'data' => 'SUCCESS'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => 'Something went wrong!']);
        }
    }
    public function address(Request $request)
    {
        $user = $request->user();
        $address = User::find($user->id);
        $response = [
            'status' => true,
            'data' => $address
        ];
        return response()->json($response, 200);
    }
    public function addAddress(Request $request)
    {
        $this->validate($request, [
            'full_name'   => 'required',
            'mobile' => 'required|numeric|digits:10',
            'pin' => 'required|numeric|digits:6',
            'city' => 'required',
            'state' => 'required'
        ]);
        $user = User::find($request->user()->id);
        if ($user) {
            $user->name = $request->input('full_name');
            $user->mobile  = $request->input('mobile');
            $user->pin  = $request->input('pin');
            $user->address  = $request->input('address');
            $user->city  = $request->input('city');
            $user->state  = $request->input('state');
            if ($user->save()) {
                return response()->json([
                    'status' => true,
                    'msg' => 'Address Updated Successfully',
                ], 200);
            }
        }
    }

    public function addRecharge(Request $request)
    {
        $this->validate($request, [
            'rechargeAmount' => 'required|numeric|same:confirmAmount'
        ]);
        $user = $request->user();
        // Payment Integration
        $order = new Order();
        $order->user_id = $user->id;
        $order->amount = $request->input('rechargeAmount');
        $order->save();
        $api = new \Instamojo\Instamojo(
            config('services.instamojo.api_key'),
            config('services.instamojo.auth_token'),
            config('services.instamojo.url')
        );
        try {
            $response = $api->paymentRequestCreate(array(
                "purpose" => "Capital Gold",
                "amount" => $request->input('rechargeAmount'),
                "buyer_name" => isset($user->name) ? $user->name : $user->username,
                "send_email" => false,
                "email" => isset($user->email) ? $user->email : 'sishack8@gmail.com',
                "phone" => $user->mobile,
                "redirect_url" => route('web.pay_order_amount', ['order_id' => encrypt($order->id)]),
            ));
            $order->payment_request_id = $response['id'];
            $order->save();
            return response()->json(['msg' => $response]);
            header('Access-Control-Allow-Origin:  http://localhost:8000');
            header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Authorization, Origin');
            header('Access-Control-Allow-Methods:  POST, PUT');
            // header('Location: ' . $response['longurl']);
            // exit();
        } catch (Exception $e) {
            print('Error: ' . $e->getMessage());
        }
    }
    public function paySuccess(Request $request, $order_id)
    {
        try {
            $order_id = decrypt($order_id);
        } catch (DecryptException $e) {
            return redirect()->back();
        }
        try {
            $api = new \Instamojo\Instamojo(
                config('services.instamojo.api_key'),
                config('services.instamojo.auth_token'),
                config('services.instamojo.url')
            );
            $response = $api->paymentRequestStatus(request('payment_request_id'));
            if (!isset($response['payments'][0]['status'])) {
                return redirect()->url('/win');
            } else if ($response['payments'][0]['status'] != 'Credit') {
                return redirect()->url('/win');
            }
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Something went wrong! Try again later']);
        }
        if ($response['payments'][0]['status'] == 'Credit') {
            try {
                $order = null;
                DB::transaction(function () use ($order_id, $response, &$order) {
                    $order = Order::where('id', $order_id)->where('payment_request_id', $response['id'])->first();
                    $order->payment_id = $response['payments'][0]['payment_id'];
                    $order->status = 2;
                    $order->save();

                    $wallet = Wallet::where('user_id', $order->user_id)->first();
                    $wallet->amount = ($wallet->amount + $response['payments'][0]['amount']);
                    $wallet->save();
                    $wallet_history = new WalletHistory();
                    $wallet_history->wallet_id = $wallet->id;
                    $wallet_history->comment  = $response['payments'][0]['amount'] . 'Amount credited to wallet';
                    $wallet_history->amount = $response['payments'][0]['amount'];
                    $wallet_history->total = $wallet->amount;
                    $wallet_history->status = 1;
                    $wallet_history->save();
                    if (!empty($order->user_id)) {
                        $order_count = Order::where('user_id', $order->user_id)->where('status', 2)->count();
                        if ($order_count == '1') {
                            $this->referralBonusCredit($order->user_id);
                        }
                    }
                });
                header('Location: ' . URL::to('/transaction'));
                exit();
            } catch (\Exception $e) {
                dd($e);
                return response()->json(['msg' => 'Something went wrong!']);
            }
        }
    }

    public function addBankCard(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'ifsc' => 'required',
            'account_no' => 'required|same:confirm_account',
            'state' => 'required',
            'city' => 'required',
            'mobile' => 'required|numeric',
            'email' => 'required|email'
        ]);
        $bank_card = new BankCard();
        $bank_card->user_id = Auth::user()->id;
        $bank_card->name = $request->input('name');
        $bank_card->ifsc = $request->input('ifsc');
        $bank_card->account_no  = $request->input('account_no');
        $bank_card->state  = $request->input('state');
        $bank_card->city  = $request->input('city');
        $bank_card->mobile  = $request->input('mobile');
        $bank_card->email  = $request->input('email');

        if ($bank_card->save()) {
            return response()->json([
                'status' => true,
                'success_code' => 'SUCCESS'
            ], 200);
        }
    }

    public function bankCards()
    {
        $bank_cards = BankCard::latest()->where('user_id', Auth::user()->id)->limit(10)->get();
        return response()->json([
            'status' => true,
            'msg' => 'Bank Card Details',
            'data' => $bank_cards
        ], 200);
    }
    private function referralBonusCredit($user_id)
    {
        $user = User::where('id', $user_id)->where('refferal_status', 2)->first();
        if ($user && !empty($user->referrer_id)) {
            $referrer = User::find($user->referrer_id);
            if ($referrer) {
                $wallet = Wallet::where('user_id', $referrer->id)->first();
                $wallet->amount = ($wallet->amount + 50);
                if ($wallet->save()) {
                    $wallet_history = new WalletHistory();
                    $wallet_history->wallet_id = $wallet->id;
                    $wallet_history->comment  = 50 . 'Referral Bonus credited to wallet';
                    $wallet_history->amount = 50;
                    $wallet_history->total = $wallet->amount;
                    $wallet_history->status = 1;
                    $wallet_history->save();
                    $user->refferal_status = 3;
                    $user->save();
                }
            }
        }
        return true;
    }

    public function addComplaints(Request $request)
    {
        $this->validate($request, [
            'type'   => 'required',
            'description' => 'required',
            'mobile' => 'required|numeric'
        ]);
        $complaint = new Complaint();
        $complaint->user_id = Auth::user()->id;
        $complaint->type = $request->input('type');
        $complaint->description  = $request->input('description');
        $complaint->mobile  = $request->input('mobile');

        if ($complaint->save()) {
            return response()->json([
                'status' => true,
                'msg' => 'Added Successfully'
            ]);
        }
    }

    public function complaints(Request $request)
    {
        $user = $request->user();
        $complaints = Complaint::where('user_id', $user->id)->limit(10)->get();
        $response = [
            'status' => true,
            'data' => $complaints
        ];
        return response()->json($response, 200);
    }
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'login_password'   => 'required',
            'new_password' => 'required|min:6|same:confirm'
        ]);
        if ($request->input('login_password') == $request->input('password')) {
            return response()->json([
                'err' => 'SAME'
            ]);
        }
        $user = User::find(Auth::user()->id);
        if (Hash::check($request->input('login_password'), $user->password)) {
            $user->password = Hash::make($request->input('new_password'));
            if ($user->save()) {
                return response()->json([
                    'status' => true,
                    'msg' => 'SUCCESS'
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'err' => 'ERROR'
            ]);
        }
    }
    public function addNickName(Request $request)
    {
        return $request;
        $nickname = $request->input('nickname');
        $user = User::find($request->user()->id);
        $user->nick_name = $nickname;
        if ($user->save()) {
            return response()->json([
                'status' => true,
                'msg' => 'Nick Name set Successfully'
            ]);
        }
    }
    private function otp($random, $mobile)
    {
        $sms = "Your otp is $random . Never share this otp with anyone";

        $username = "EAGLES";
        $api_password = "9aea6ekp33h4xua3c";
        $sender = "EAGLEO";
        $domain = "http://sms.webinfotech.co";
        $priority = "4"; // 11-Enterprise, 12- Scrub, 4=OTP
        $method = "GET";
        $message = $sms;

        $username = urlencode($username);
        $api_password = urlencode($api_password);
        $sender = urlencode($sender);
        $message = urlencode($message);

        $sms = urlencode($sms);

        $parameters = "username=$username&api_password=$api_password&sender=$sender&to=$mobile&message=$message&priority=$priority";
        $url = "$domain/pushsms.php?" . $parameters;
        $ch = curl_init($url);

        if ($method == "POST") {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        } else {
            $get_url = $url . "?" . $parameters;

            curl_setopt($ch, CURLOPT_POST, 0);
            curl_setopt($ch, CURLOPT_URL, $get_url);
        }
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);  // DO NOT RETURN HTTP HEADERS 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // RETURN THE CONTENTS OF THE CALL
        $return_val = curl_exec($ch);
        return $random;
    }
}
