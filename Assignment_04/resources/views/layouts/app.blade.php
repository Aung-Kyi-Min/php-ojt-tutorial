<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment_01</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
</head>
<body>
  <div class="row">
  <nav class="navbar navbar-light bg-light">
    <div class="menu w-75 mx-auto">
    <a class="navbar-brand" href="#">Navbar</a>
    <div class="row float-end">
    <a href="{{route('students.index')}}" class="col-md-6 text-decoration-none text-dark ">Students</a>
    <a href="{{route('majors.index')}}" class="col-md-6 text-decoration-none text-secondary ">Majors</a>
    </div>
  </div>
</nav>
  </div>

  @yield('content')

</body>
</html>
