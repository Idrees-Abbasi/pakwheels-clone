@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Buyer's Requests to Contact</h2>

    @if($requests->isEmpty())
        <p>No requests yet.</p>
    @else
        <table class="table table-bordered mt-3">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Product Title</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>WhatsApp</th>
                    <th>Address</th>
                    <th>Offer</th>
                    <th>Submitted At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $index => $req)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $req->product->title ?? 'N/A' }}</td>
                        <td>{{ $req->name }}</td>
                        <td>{{ $req->phone }}</td>
                        <td>{{ $req->whatsapp ?? 'N/A' }}</td>
                        <td>{{ $req->address }}</td>
                        <td>{{ $req->offer }}</td>
                        <td>{{ $req->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
