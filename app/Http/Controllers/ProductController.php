<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Mail\ProductAddedMail;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        // 1. Validate form data
        $request->validate([
            'category'    => 'required|string|max:255',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:1',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 2. Image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }
    // ✅ Product create and save
    $product = new Product();
    $product->category    = $request->category;
    $product->title       = $request->title;
    $product->description = $request->description;
    $product->price       = $request->price;
    $product->image       = $imagePath; // 👈 image bhi save hogi
    $product->seller_id   = auth()->guard('seller')->id();
    $product->save();

    // ✅ Email bhejna
    try {
        Mail::to("idreesabbasi006@gmail.com")->send(new ProductAddedMail($product));
    } catch (\Exception $e) {
        return back()->with("error", "❌ Mail failed: " . $e->getMessage());
    }

    // ✅ Redirect with success message
    return redirect()->route('welcome')->with('success', 'Product added successfully & E-mail Sent !');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.show', compact('product'));
    }

    public function index()
    {
        // Sirf us seller ke products dikhana jo login hai
        $seller = auth()->guard('seller')->user();

        if (!$seller) {
            return redirect()->route('seller.login')->withErrors('Please login first.');
        }

        // ✅ yahan bhi seller_id use karo (tumne galti se user_id likha tha)
        $products = Product::where('seller_id', $seller->id)->get();

        return view('product.index', compact('products'));
    }

    public function edit($id)
{
    $product = Product::findOrFail($id);

    // Ensure product belongs to logged-in seller
    if ($product->seller_id !== auth()->guard('seller')->id()) {
        abort(403, 'Unauthorized action.');
    }

    return view('product.edit', compact('product'));
}

public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    if ($product->seller_id !== auth()->guard('seller')->id()) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'category'    => 'required|string|max:255',
        'title'       => 'required|string|max:255',
        'description' => 'required|string',
        'price'       => 'required|numeric|min:1',
        'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $imagePath = $product->image;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('product', 'public');
    }

    $product->update([
        'category'    => $request->category,
        'title'       => $request->title,
        'description' => $request->description,
        'price'       => $request->price,
        'image'       => $imagePath,
    ]);

    return redirect()->route('welcome')->with('success', 'Product updated successfully!');
}

public function destroy($id)
{
    $product = Product::findOrFail($id);

    $product->delete();

    return redirect()->route('welcome')->with('success', 'Product deleted successfully!');
}

}
