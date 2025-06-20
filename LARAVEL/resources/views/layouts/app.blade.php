<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SISFO SARPRAS</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
</head>
<body style="font-family: 'Nunito', sans-serif;">
    <div class="flex min-h-screen w-screen overflow-x-hidden">
        @include('sweetalert::alert')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @include('partials.sidebar')
        @yield('content')

    </div>
</body>
</html>
