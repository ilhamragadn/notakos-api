<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>NOTAKOS - Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #fff;
            }

            .sidenav {
                height: 100%;
                width: 250px;
                position: fixed;
                top: 0;
                left: 0;
                background-color: #f0f0f0;
                padding-top: 20px;
                border-right: 1px solid #ddd;
            }

            .sidenav a {
                padding: 10px 15px;
                text-decoration: none;
                font-size: 18px;
                color: #333;
                display: block;
            }

            .sidenav a.active,
            .sidenav a:hover {
                background-color: #0284C7;
                color: white;
            }

            .main-content {
                margin-left: 250px;
                padding: 20px;
            }

            .navbar {
                background-color: #0284C7;
            }

            .navbar .navbar-brand,
            .navbar .nav-link {
                color: white;
            }

            .navbar .nav-link:hover {
                color: #ddd;
            }

            .footer {
                position: fixed;
                left: 250px;
                bottom: 0;
                width: calc(100% - 250px);
                background-color: #0284C7;
                color: white;
                text-align: center;
                padding: 10px 0;
            }
        </style>
    </head>

    <body>

        <div class="sidenav text-center">
            <a href="{{ route('admin.dashboard') }}" class="my-1">Dashboard</a>
            <a href="{{ route('admin-user.index') }}" class="my-1">Pengguna</a>
            <a href="{{ route('admin-literature.index') }}" class="my-1">Literatur</a>

            <div>
                <a href="{{ route('admin.logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        <div class="main-content">
            <div class="container mt-2">
                @yield('content')
            </div>
        </div>

        <div class="footer">
            &copy; 2024 NOTAKOS. All rights reserved.
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script>
            //message with toastr
            @if (session()->has('success'))

                toastr.success('{{ session('success') }}', 'BERHASIL!');
            @elseif (session()->has('error'))

                toastr.error('{{ session('error') }}', 'GAGAL!');
            @endif
        </script>
    </body>

</html>
