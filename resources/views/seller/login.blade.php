<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Login - PakWheels</title>
    
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .login-title {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            color: #0d6efd;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #0d6efd;
        }
        .btn-login {
            background-color: #0d6efd;
            color: #fff;
            width: 100%;
        }
        .btn-login:hover {
            background-color: #0b5ed7;
        }
        .alert {
            border-radius: 8px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2 class="login-title">Seller Login</h2>

        <!-- Success Message -->
        @if(session('success'))
            <div id="success-message" class="alert alert-success">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(function(){
                    var msg = document.getElementById('success-message');
                    if(msg){ msg.style.display = 'none'; }
                }, 5000);
            </script>
        @endif

        <!-- Error Message -->
        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('seller.login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <div class="mb-3 position-relative">
    <label for="password" class="form-label">Password</label>
    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
    <span id="togglePassword" style="position:absolute; top:38px; right:10px; cursor:pointer; color:#0d6efd;">
        👁
    </span>
</div>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        // toggle type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        // optional: change icon
        this.textContent = type === 'password' ? '👁' : '🙈';
    });
</script>


            <button type="submit" class="btn btn-login">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
