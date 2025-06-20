<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet"href="https://fonts.googleapis.com/css?family=Nunito  ">
    <title>Login</title>
</head>
<body class="relative h-screen overflow-hidden">
    <!-- Gambar blur di belakang -->
    <div class="absolute inset-0 z-0">
        <img class="w-full h-full object-cover blur-xs" src="{{ asset('Assets/bg.jpg') }}" alt="">
    </div>

    <!-- Form login di atas -->
        <div class="relative z-10 flex items-center justify-center h-full">
            <div class="bg-[#EEF1F6] p-6 rounded-[14px] text-black w-90 h-115 justify-items-center">
                <img class="w-40 h-auto" src="{{ asset('Assets/logo.png') }}" alt="">
                <h1 style="font-family: 'Nunito', serif; font-weight: 900;" class="text-xl font-bold mb-4 tracking-wider">SISFO SARPRAS</h1>
                <form action="/login" method="post" class="justify-items-center">
                    @csrf
                    <input class="block mb-2 mt-[1.5rem] p-2.5 outline-none rounded-[14px] w-70 bg-[#FFFFFF] drop-shadow-lg/40" type="text" name="name" placeholder="Username" required>
                    <input class="block mb-4 mt-[2rem] p-2.5 outline-none rounded-[14px] w-70 bg-[#FFFFFF] drop-shadow-lg/40" type="password" name="password" placeholder="Password" required>
                    <button type="submit" class="mt-[1.5rem] bg-[#377DC2] drop-shadow-lg/40 text-white px-4 py-2 rounded w-50"><p style="font-family: 'Nunito', serif; font-weight: 400;">Login</p></button>
                </form>
            </div>
        </div>
        @include('sweetalert::alert')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>