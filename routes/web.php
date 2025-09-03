<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactSellerController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\ContactRequestController;
use App\Http\Controllers\AdminLoginController;


// -------------------- Login Routes --------------------
// Show login form (single form for user & admin)
Route::get('/login', [LoginController::class,'showLoginForm'])->name('login');

// Handle login submit
Route::post('/login', [LoginController::class,'login'])->name('login.submit');

// -------------------- Dashboards --------------------
// User dashboard
Route::get('/welcome', function(){
    return view('welcome');
})->middleware('auth:web')->name('welcome');

// Admin dashboard
Route::get('/admin/dashboard', function(){
    return view('admin.dashboard');
})->middleware('auth:admin')->name('admin.dashboard');

// -------------------- Logout --------------------
Route::post('/logout', [LoginController::class,'logout'])->name('logout');



// edit and delete the products from the listing 
Route::middleware(['auth:seller'])->group(function () {
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/seller/listings', [SellerController::class, 'listings'])->name('seller.listings');


// Seller dashboard - list of contact requests
Route::middleware('auth:seller')->group(function() {
    Route::get('/seller/requests', [ContactRequestController::class, 'index'])
        ->name('seller.requests');
});


// Submit contact request (buyer)
Route::post('/contact-seller/{product}', [ContactRequestController::class, 'store'])
    ->name('contact.seller.submit');

// Seller dashboard - view all requests
Route::middleware('auth:seller')->group(function() {
    Route::get('/seller/requests', [ContactRequestController::class, 'index'])
        ->name('seller.requests');
});


// Home + Welcome page (showing products)
Route::get('/', function () {
    $products = Product::latest()->get();
    return view('welcome', compact('products'));
})->name('welcome');

// Optional: redirect /welcome to /
Route::get('/welcome', function () {
    return redirect()->route('welcome');
});

// Single product details page
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Show contact form for a product
Route::get('/contact-seller/{product}', [ContactSellerController::class, 'showForm'])->name('contact.seller');
// Handle form submission
Route::post('/contact-seller/{product}', [ContactSellerController::class, 'submitForm'])->name('contact.seller.submit');

// Static Pages
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::view('/listings', 'listings')->name('listings');
Route::view('/reviews', 'reviews')->name('reviews');

// User Authentication
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// Seller Authentication
Route::get('/seller/login', [SellerController::class, 'showLoginForm'])->name('seller.login');
Route::post('/seller/login', [SellerController::class, 'login'])->name('seller.login.submit');
Route::post('/seller/logout', [SellerController::class, 'logout'])->name('seller.logout');

// Seller Routes
// Route::get('/seller/dashboard', [SellerController::class, 'dashboard'])->name('seller.dashboard');
// Route::get('/seller/product/add', [ProductController::class, 'create'])->name('seller.product.create');
// Route::post('/seller/product/store', [ProductController::class, 'store'])->name('products.store');

Route::get('/seller/dashboard', function () {
    return view('seller.dashboard');
})->name('seller.dashboard');

// seller dashboard ka ma options k routes 
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/seller/logout', function () {
    Auth::guard('seller')->logout();   // seller guard logout
    return redirect()->route('welcome'); // logout ke baad welcome page
})->name('seller.logout');
Route::post('/seller/logout', [SellerController::class, 'logout'])->name('seller.logout');
Route::resource('products', ProductController::class);

Route::get('/', function () {
    $products = Product::latest()->get();
    return view('welcome', compact('products'));
})->name('welcome');

// is sa category k hisab sa product filter hu ga 
Route::get('/', function (Request $request) {
    $category = $request->query('category'); // URL se category le raha hai

    if ($category) {
        $products = Product::where('category', $category)->latest()->get();
    } else {
        $products = Product::latest()->get();
    }

    $categories = Product::select('category')->distinct()->get();

    return view('welcome', compact('products', 'categories', 'category'));
})->name('welcome');


