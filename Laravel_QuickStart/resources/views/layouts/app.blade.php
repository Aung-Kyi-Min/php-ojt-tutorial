<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laravel Quickstart - Basic</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-default">
            <!-- Navbar Contents -->
            <a href="#" class="text-decoration-none text-dark">Nav</a>
        </nav>
    </div>

    @yield('content')

</body>

</html>
