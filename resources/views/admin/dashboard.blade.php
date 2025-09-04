<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .box {
            width: 200px;
            padding: 20px;
            margin: 10px;
            background: #f1f1f1;
            border-radius: 8px;
            text-align: center;
            float: left;
        }
        h2 { margin: 0; }
    </style>
</head>
<body>

<h1>📊 Admin Dashboard</h1>

<div class="box">
    <h2 id="productsCount">0</h2>
    <p>Products</p>
</div>

<div class="box">
    <h2 id="usersCount">0</h2>
    <p>Users</p>
</div>

<div class="box">
    <h2 id="sellersCount">0</h2>
    <p>Sellers</p>
</div>

<div class="box">
    <h2 id="adminsCount">0</h2>
    <p>Admins</p>
</div>

<script>
$(document).ready(function() {
    function loadCounts() {
        $.ajax({
            url: "/get-counts", // Laravel route
            method: "GET",
            success: function(data) {
                document.getElementById("productsCount").innerText = data.products;
                document.getElementById("usersCount").innerText    = data.users;
                document.getElementById("sellersCount").innerText  = data.sellers;
                document.getElementById("adminsCount").innerText   = data.admins;
            },
            error: function(xhr, status, err) {
                console.error("AJAX Error:", err);
            }
        });
    }

    // Pehle load karo page load hone par
    loadCounts();

    // Har 2 second me counts reload karo
    setInterval(loadCounts, 2000); // 2000ms = 2 seconds
});
</script>


</body>
</html>
