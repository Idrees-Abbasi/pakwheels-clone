<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        // 🔹 Pehle Admin check karo
        $admin = Admin::where('email', $request->email)->first();
        if($admin && Hash::check($request->password, $admin->password)){
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.dashboard');
        }

        // 🔹 User check karo
        $credentials = $request->only('email','password');
        if(Auth::guard('web')->attempt($credentials)){
            return redirect()->route('welcome')->with('success', 'Login Successful!');;
        }

        return back()->with('error','Invalid Credentials');
    }

    public function logout(Request $request)
    {
        if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
        } else {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
