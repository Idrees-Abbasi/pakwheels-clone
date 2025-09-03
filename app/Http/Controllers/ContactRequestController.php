<?php

namespace App\Http\Controllers;

use App\Models\ContactRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactRequestController extends Controller
{
    // Store contact request from buyer
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'whatsapp'=> 'nullable|string|max:20',
            'address' => 'required|string',
            'offer'   => 'required|string',
        ]);

        ContactRequest::create([
            'product_id' => $product->id,
            'name'       => $request->name,
            'phone'      => $request->phone,
            'whatsapp'   => $request->whatsapp,
            'address'    => $request->address,
            'offer'      => $request->offer,
        ]);

        return back()->with('success', 'Your request has been sent successfully!');
    }

    // Seller Dashboard - list all requests
public function index()
{
    // Fetch all requests with related product
$requests = ContactRequest::whereHas('product', function ($query) {
    $query->where('seller_id', auth('seller')->id());
})->get();

    return view('seller.contact_requests', compact('requests'));
}
}
