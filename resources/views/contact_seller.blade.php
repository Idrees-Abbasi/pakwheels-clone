<div class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="form-wrapper shadow-lg p-5 rounded-4 bg-white" style="width: 100%; max-width: 550px;">
        <h2 class="text-center fw-bold mb-4 text-primary">Contact Seller</h2>
        <p class="text-center mb-4">For: <strong>{{ $product->title }}</strong></p>

        @if(session('success'))
            <div class="alert alert-success rounded-3 text-center">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contact.seller.submit', $product->id) }}" method="POST">
            @csrf

            <div class="form-group mb-4">
                <input type="text" class="form-control custom-input" id="name" name="name" required placeholder=" ">
                <label class="custom-label" for="name">Full Name <span class="text-danger">*</span></label>
            </div>

            <div class="form-group mb-4">
                <input type="text" class="form-control custom-input" id="phone" name="phone" required placeholder=" ">
                <label class="custom-label" for="phone">Phone Number <span class="text-danger">*</span></label>
            </div>

            <div class="form-group mb-4">
                <input type="text" class="form-control custom-input" id="whatsapp" name="whatsapp" placeholder=" ">
                <label class="custom-label" for="whatsapp">WhatsApp (Optional)</label>
            </div>

            <div class="form-group mb-4">
                <textarea class="form-control custom-input" id="address" name="address" rows="3" required placeholder=" "></textarea>
                <label class="custom-label" for="address">Address <span class="text-danger">*</span></label>
            </div>

            <div class="form-group mb-5">
                <input type="text" class="form-control custom-input" id="offer" name="offer" required placeholder=" ">
                <label class="custom-label" for="offer">Your Offer <span class="text-danger">*</span></label>
            </div>

            <button type="submit" class="btn btn-gradient w-100 btn-lg fw-bold">Send Request</button>
        </form>
    </div>
</div>

<!-- Custom CSS -->
<style>
    body {
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
    }

    /* Input fields */
    .custom-input {
        border: 2px solid #ddd;
        border-radius: 0.5rem;
        padding: 1rem 1rem 0.5rem 1rem;
        font-size: 1rem;
        background: #fff;
        transition: 0.3s;
    }
    .custom-input:focus {
        border-color: #007bff;
        box-shadow: 0 0 10px rgba(0,123,255,0.2);
        outline: none;
    }

    /* Floating Labels */
    .custom-label {
        position: absolute;
        left: 1rem;
        top: 1rem;
        pointer-events: none;
        font-size: 0.9rem;
        color: #6c757d;
        transition: 0.3s ease all;
    }
    .custom-input:focus + .custom-label,
    .custom-input:not(:placeholder-shown) + .custom-label {
        top: -0.5rem;
        left: 0.75rem;
        font-size: 0.8rem;
        color: #007bff;
        background: #fff;
        padding: 0 0.25rem;
    }

    /* Button */
    .btn-gradient {
        background: linear-gradient(90deg, #007bff, #6610f2);
        border: none;
        color: #fff;
        padding: 0.75rem;
        border-radius: 0.5rem;
        transition: 0.3s;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    .form-group {
        position: relative;
    }
</style>
