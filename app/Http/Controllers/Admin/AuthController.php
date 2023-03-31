<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserLoginAccess;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            UserLoginAccess::where('user_id', auth()->user()->id)->delete();
            $login_access = UserLoginAccess::create([
                'access_token' => uniqid(),
                'expired_at' => Carbon::now()->addDay(),
                'user_id' => auth()->guard()->user()->id
            ]);
            session(['access_token' => $login_access->access_token]);
            return redirect(route('user_list'));
        }else {
            return back()->withErrors([
                'message' => 'Invalid credential.'
            ]);
        }
    }

    public function logout()
    {
        UserLoginAccess::where('user_id', auth()->user()->id)->delete();
        session([
            'access_token' => null
        ]);
        return redirect(route('login'));
    }
}
