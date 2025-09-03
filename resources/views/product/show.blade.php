@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <!-- Product Image -->
        <div class="col-md-6">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid rounded shadow-sm" alt="{{ $product->title }}">
            @else
                <img src="{{ asset('images/no-image.png') }}" class="img-fluid rounded shadow-sm" alt="No Image">
            @endif
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h2 class="mb-3">{{ $product->title }}</h2>
            <p class="text-muted mb-2">{{ $product->description }}</p>
            <h4 class="text-primary mb-3">{{ number_format($product->price) }} PKR</h4>
            <p><strong>Category:</strong> {{ ucfirst($product->category) }}</p>

            <div class="mt-4">
                {{-- <a href="#" class="btn btn-success me-2">Add to Cart</a> --}}
                @if(isset($product->seller_id))
                    <a href="{{ route('contact.seller', $product->id) }}" class="btn btn-outline-primary">Contact Seller</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
