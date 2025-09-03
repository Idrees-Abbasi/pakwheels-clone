<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PakWheels Clone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #003366;
        }
        .navbar a {
            color: white !important;
        }
        .form-container {
            max-width: 450px;
            margin: 50px auto;
            padding: 25px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .btn-pakwheels {
            background-color: #003366;
            color: white;
        }
        .btn-pakwheels:hover {
            background-color: #0055aa;
            color: #fff;
        }
        .footer-links a {
            color: #fff;
            text-decoration: none;
        }
        .footer-links a:hover {
            text-decoration: underline;
        }
        .social-icons a {
            font-size: 1.3rem;
            margin-right: 10px;
            color: #fff;
        }
        .social-icons a:hover {
            color: #0d6efd;
        }
    </style>
</head>
<body>

    <!-- Content -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <footer class="bg-dark text-white p-4 mt-5">
        <div class="container">
            <div class="row">
                <!-- About -->
                <div class="col-md-4">
                    <h5>About Us</h5>
                    <p>
                        Welcome to <strong>Pakwheels clone</strong>, your trusted platform for buying, selling,
                        and exploring vehicles just like PakWheels. We connect car enthusiasts, buyers,
                        and sellers in one place.
                    </p>
                </div>

                <!-- Contact -->
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <p><strong>Address:</strong> DHA Phase 1, Islamabad, Pakistan</p>
                    <p><strong>Email:</strong> quadtrum@pakwheelsclone.com</p>
                    <p><strong>Phone:</strong> +92 349 0005017</p>
                </div>

                <!-- Quick Links -->
                <div class="col-md-2 footer-links">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="/">Home</a></li>
                        <li><a href="/?category=Cars">Cars</a></li>
                        <li><a href="/?category=Bikes">Bikes</a></li>
                        <li><a href="/seller/login">Sell Your Car</a></li>
                    </ul>
                </div>

                <!-- Follow Us -->
                <div class="col-md-2 social-icons">
                    <h5>Follow Us</h5>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-twitter"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            <div class="text-center mt-3">
                <p>&copy; 2025 PakWheels Clone. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>
