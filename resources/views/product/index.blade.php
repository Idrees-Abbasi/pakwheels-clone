@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Your Listings</h2>

    @if($products->count())
        <ul>
            @foreach($products as $product)
                <li>{{ $product->title }} - {{ $product->price }}</li>
            @endforeach
        </ul>
    @else
        <p>No products listed yet.</p>
    @endif
</div>
@endsection
