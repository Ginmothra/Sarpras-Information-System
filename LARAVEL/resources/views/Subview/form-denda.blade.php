<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito  ">
    <title>Tambah Denda</title>
</head>

<body class="relative h-screen overflow-hidden">
    <!-- Gambar blur di belakang -->
    <div class="absolute inset-0 z-0">
        <img class="w-full h-full object-cover blur-xs" src="{{ asset('Assets/bg.jpg') }}" alt="">
    </div>

    {{-- div dan button back --}}
    <div class="absolute top-7 left-5 z-20">
        <a href="{{ url()->previous() }}"
            class="bg-red-700 text-white drop-shadow-md px-4 py-2 rounded-lg border border-white hover:bg-red-800">Back</a>
    </div>

    <!-- Form tambah -->
    <div class="relative z-10 flex items-center justify-center h-full">
        <form action="{{ route('insert.denda',) }}" method="post" enctype="multipart/form-data"
            class="bg-[#EEF1F6] p-6 rounded-[14px] text-black w-90 h-145 flex flex-col items-center">
            @csrf
            <img src="{{ asset('Assets/logo.png') }}" alt="" class="w-40 h-auto mb-2">

            <h1 class="text-xl font-bold mb-4 tracking-wider" style="font-family: 'Nunito', serif; font-weight: 900;">
                TAMBAH DENDA
            </h1>
            <span class="mr-20 mb-1.5 w-50">Denda Untuk: {{ $nama }}</span>
            <input type="hidden" name="nisn" value="{{ $nisn }}">
            <input type="hidden" name="from" value="{{ $from }}">
            <label class="mr-20 mb-1.5 w-50" for="jumlah">Jumlah Denda:</label>
            <input type="number" name="jumlah" id="jumlah"
                class="block mb-4 p-2.5 outline-none rounded-[14px] w-70 bg-white drop-shadow-lg/40"
                placeholder="Contoh: 5000" required>
            <label class="mr-20 mb-1.5 w-50" for="keterangan">Keterangan:</label>
            <textarea name="keterangan" id="keterangan" class="block mb-4 p-2.5 outline-none rounded-[14px] w-70 h-25 bg-white drop-shadow-lg/40"
            placeholder="Contoh: Denda karena keterlambatan pengembalian barang" required></textarea>


            <button type="submit" class="mt-6 bg-[#377DC2] drop-shadow-lg/40 text-white px-4 py-2 rounded w-50">
                <p style="font-family: 'Nunito', serif; font-weight: 400;">Tambah Denda</p>
            </button>
        </form>
    </div>

</body>

</html>