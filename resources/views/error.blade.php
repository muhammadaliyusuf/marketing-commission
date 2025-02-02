<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Payment Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .error-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .error-container h1 {
            font-size: 4rem;
            font-weight: bold;
            color: #dc3545;
        }
        .error-container p {
            font-size: 1.5rem;
            color: #6c757d;
        }
        .error-container a {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div>
            <h1>404</h1>
            <p>Oops! Payment not found.</p>
            <p>The payment you are looking for does not exist.</p>
            <a href="{{ url('/') }}" class="btn btn-primary">Go to Homepage</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>