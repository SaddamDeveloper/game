<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function dashboardView()
    {
        $userCount = User::count();
        $users = User::latest()->paginate(10);
        return view('admin.dashboard', compact('users', 'userCount'));
    }

    public function changePasswordForm()
    {
        return view('admin.change_password');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required',
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'same:confirm_password'],
        ]);

        $user = Admin::where('id',1)->first();
        
        if(Hash::check($request->input('current_password'), $user->password)){  
            Admin::where('id',1)->update([
                'email' =>$request->input('email'),
'                password'=>Hash::make($request->input('new_password')),
            ]);
        }else{
            return redirect()->back()->with('error','Sorry Current Password Does Not Correct');
        }
    }
}
