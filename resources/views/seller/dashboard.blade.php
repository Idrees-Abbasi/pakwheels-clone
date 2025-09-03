<!-- resources/views/seller/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Seller Dashboard</h2>
    <ul>
<li><a href="{{ route('seller.listings') }}">Your Listings</a></li>
        <li><a href="{{ route('products.create') }}">Add Product</a></li>
        <li><a href="{{ route('seller.requests') }}">Buyer's Requests to Contact</a></li>
        {{-- <li><a href="{{ route('logout') }}">Sign Out</a></li> --}}
        <form method="POST" action="{{ route('seller.logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>

    </ul>
</div>
@endsection
