<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>
<aside class="sidebar bg-white border-end">


    <ul class="nav flex-column p-3 gap-1">

        <li class="nav-item">
            <a class="nav-link active" href="{{ url('/components/dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-bag me-2"></i>
                Orders
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-box-seam me-2"></i>
                Products
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-folder me-2"></i>
                Categories
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-bar-chart me-2"></i>
                Reports
            </a>
        </li>

        <li class="nav-item mt-3 text-muted small px-3">
            SETTINGS
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-gear me-2"></i>
                Settings
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-danger" href="#">
                <i class="bi bi-box-arrow-right me-2"></i>
                Logout
            </a>
        </li>

    </ul>
</aside>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>