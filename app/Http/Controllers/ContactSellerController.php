<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ContactRequest; // ye table hume banani hai

class ContactSellerController extends Controller
{

    // Handle form submission
    public function submitForm(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'whatsapp' => 'nullable',
            'address' => 'required',
            'offer' => 'required',
        ]);

        ContactRequest::create([
            'product_id' => $product->id,
            'name' => $request->name,
            'phone' => $request->phone,
            'whatsapp' => $request->whatsapp,
            'address' => $request->address,
            'offer' => $request->offer,
        ]);

        return redirect()->route('welcome')->with('success', 'Your request has been sent to the seller!');

    }
    // show the contact form 
    public function showForm(Product $product)
{
    return view('contact_seller', compact('product')); // ye $product blade me use hoga
}

}
