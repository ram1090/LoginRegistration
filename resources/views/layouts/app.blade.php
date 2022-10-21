<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Fontawesome style cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap css  -->
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/dashboard.css')}}">
</head>

<body>
    <div class="w-100 d-flex align-items-between" style="height:100vh;">
        @include('includes.sidebar')
        <div class="main-page" style="width : calc(100% - 250px);margin-left:250px;transition:all 350ms;">
            @include('includes.topNavbar')
            <main class="p-4 bg-light" style="min-height:480px;">
                @yield("content")
            </main>
            <footer class="w-100 bg-primary p-2">
                <p class="p-0 m-0 text-white">Design & Developed By : Ramshankar Maurya</p>
            </footer>
        </div>
    </div>
    <!-- Fontawesome script cdn  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"
        integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap script  -->
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/dashboard.js')}}"></script>
</body>

</html>