@extends('layouts.app')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">PakWheels Clone</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                <a href="{{ route('seller.login') }}" class="btn btn-primary ms-2">Login as Seller</a>
            </ul>
        </div>
    </div>
</nav>

<!-- Success Message -->
@if(session('success'))
    <div id="successMessage"
        style="position: fixed; top: 10px; left: 50%; transform: translateX(-50%);
            background: #28a745; color: white; padding: 12px 20px;
            border-radius: 8px; z-index: 9999; font-weight: bold;
            box-shadow: 0px 4px 6px rgba(0,0,0,0.2);">
        {{ session('success') }}
    </div>
@endif
<script>
setTimeout(function(){
    let alertBox = document.getElementById('successMessage');
    if(alertBox){ alertBox.style.display = 'none'; }
}, 3000);
</script>

<!-- Category Filter Section -->
<div class="container mb-5" style="margin-top: 60px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="category-card p-4 text-center">
                <form method="GET" action="{{ route('welcome') }}" class="d-flex justify-content-center align-items-center flex-wrap">
                    <select name="category" id="category" class="form-select me-2 mb-2" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->category }}" {{ ($category == $cat->category) ? 'selected' : '' }}>
                                {{ ucfirst($cat->category) }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-gradient mb-2">
                        <i class="bi bi-funnel-fill"></i> Filter
                    </button>
                </form>

                <div class="mt-3">
                    <h5 class="text-white">
                        {{ $category ? 'Showing: '.ucfirst($category) : 'Showing All Products' }}
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS -->
<style>
.category-card {
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.25);
    transition: transform 0.3s, box-shadow 0.3s;
}
.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.35);
}
.form-select {
    border-radius: 50px;
    padding: 0.5rem 1rem;
    min-width: 200px;
    box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}
.form-select:hover {
    box-shadow: 0 6px 12px rgba(0,0,0,0.15);
}
.btn-gradient {
    background: linear-gradient(135deg, #ff7e5f, #feb47b);
    border: none;
    color: #fff;
    border-radius: 50px;
    padding: 0.5rem 1.5rem;
    transition: all 0.3s ease;
}
.btn-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}
</style>



<!-- Featured Products (Static Example) -->
<section class="container my-5">
    <div class="row text-center" id="productSection">
        <!-- Example static products remain here if you want -->
    </div>
</section>

{{-- yaha pa products show hu ga jo sell k leya seller lagay ga  --}}
<h2 class="text-center my-4">All Products</h2>

<div class="row row-cols-1 row-cols-md-3 g-4">
    @forelse($products as $product)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <span class="badge bg-secondary">{{ ucfirst($product->category) }}</span>
                <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="{{ $product->title }}" style="height:200px; object-fit:cover;">
                
                <div class="card-body">
                    <h5 class="card-title">{{ $product->title }}</h5>
                    <p class="card-text text-truncate" style="max-height:60px;">{{ $product->description }}</p>
                </div>
                
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <strong class="text-primary">{{ number_format($product->price) }} PKR</strong>
                    <div>
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                        @if($product->id)
                            <a href="{{ route('contact.seller', $product->id) }}" class="btn btn-sm btn-outline-success">Contact Seller</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p class="text-center">No products available.</p>
    @endforelse
</div>


<!-- Footer -->
<script>
function showProduct() {
    let category = document.getElementById('categorySelect').value;
    let items = document.querySelectorAll('.product-item');

    items.forEach(function(item){
        if(category === "Choose Category") {
            item.style.display = 'block';
        } else if(item.getAttribute('data-category') === category) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}
</script>

@endsection
