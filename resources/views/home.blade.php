<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketing Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <!-- Centered Card -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-5">
                    <h1 class="mb-4 text-primary fw-bold">Ticketing Management System</h1>
                    <p class="lead text-secondary">
                        Welcome to the Ticketing Management System
                    </p>
                    <div class="mt-4">
                        <!-- Buttons for Login and Register -->
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-3">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
