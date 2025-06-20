<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <title>Edit Siswa</title>
</head>
<body class="relative h-screen overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img class="w-full h-full object-cover blur-xs" src="{{ asset('Assets/bg.jpg') }}" alt="">
    </div>

    <div class="absolute top-7 left-5 z-20">
        <a href="{{ route('siswa.index') }}" class="bg-red-700 text-white drop-shadow-md px-4 py-2 rounded-lg border border-white hover:bg-red-800">Back</a>
    </div>

    <div class="relative z-10 flex items-center justify-center h-full">
        <form action="{{ route('siswa.update', $siswa->nisn) }}" method="POST" class="bg-[#EEF1F6] p-6 rounded-[14px] text-black w-90 h-auto flex flex-col items-center">
            @csrf
            <img class="w-40 h-auto" src="{{ asset('Assets/logo.png') }}" alt="">
            <h1 style="font-family: 'Nunito', serif; font-weight: 900;" class="text-xl font-bold mb-4 tracking-wider">EDIT SISWA</h1>

            <input class="block mb-4 p-2.5 outline-none rounded-[14px] w-70 bg-white drop-shadow-lg/40" type="text" name="nisn" value="{{ old('nisn', $siswa->nisn) }}" required placeholder="NISN">
            <input class="block mb-4 p-2.5 outline-none rounded-[14px] w-70 bg-white drop-shadow-lg/40" type="text" name="username" value="{{ old('username', $siswa->username) }}" required placeholder="Username">
            <input class="block mb-4 p-2.5 outline-none rounded-[14px] w-70 bg-white drop-shadow-lg/40" type="password" name="password" placeholder="Password Baru (Opsional)">

            <button type="submit" class="mt-6 bg-[#377DC2] drop-shadow-lg/40 text-white px-4 py-2 rounded w-50">
                <p style="font-family: 'Nunito', serif; font-weight: 400;">Update Siswa</p>
            </button>
        </form>
    </div>
</body>
</html>
