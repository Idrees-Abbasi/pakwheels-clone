<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;

class SellerController extends Controller
{
    // Seller login form show karega
    public function showLoginForm()
    {
        return view('seller.login'); // seller/login.blade.php file
    }

    // Seller login (agar pehli dafa login kare to auto-register ho jaye)
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Email check karo
        $seller = Seller::where('email', $request->email)->first();

        // Agar seller nahi mila to naya seller create kar do
        if (!$seller) {
            $seller = Seller::create([
                'name' => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);
        }

// Seller Login
if (Auth::guard('seller')->attempt([
    'email' => $request->email,
    'password' => $request->password
])) {
    return redirect()->route('seller.dashboard');
}

return back()->with('error', 'Invalid seller credentials');
    }
    // Seller dashboard
    public function dashboard()
    {
        return view('seller.dashboard');
    }

    protected function authenticated(Request $request, $user)
{
    if ($user->role === 'seller') {
        return redirect()->route('seller.dashboard');
    }

    return redirect()->route('welcome');
}

public function logout()
{
    Auth::guard('seller')->logout();
    return redirect()->route('welcome');
}

    public function listings()
    {
        // Sirf logged-in seller ke products
        $products = Product::where('seller_id', Auth::guard('seller')->id())->get();

        return view('seller.listings', compact('products'));
    }
}
