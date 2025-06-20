<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito  ">
    <title>Tambah Barang</title>
</head>

<body class="relative h-screen overflow-hidden">
    @include('sweetalert::alert')
    <!-- Gambar blur di belakang -->
    <div class="absolute inset-0 z-0">
        <img class="w-full h-full object-cover blur-xs" src="{{ asset('Assets/bg.jpg') }}" alt="">
    </div>

    {{-- div dan button back --}}
    <div class="absolute top-7 left-5 z-20">
        <a href="/dashboard/data-barang"
            class="bg-red-700 text-white drop-shadow-md px-4 py-2 rounded-lg border border-white hover:bg-red-800">Back</a>
    </div>

    <!-- Form tambah -->
    <div class="relative z-10 flex items-center justify-center h-full">
        <form action="{{ route('tambah.barang') }}" method="POST" enctype="multipart/form-data"
            class="bg-[#EEF1F6] p-6 rounded-[14px] text-black w-90 h-145 flex flex-col items-center">
            @csrf
            <img src="{{ asset('Assets/logo.png') }}" alt="" class="w-40 h-auto mb-2">

            <h1 class="text-xl font-bold mb-4 tracking-wider" style="font-family: 'Nunito', serif; font-weight: 900;">
                TAMBAH BARANG
            </h1>

            <input type="text" name="nama" placeholder="Nama Barang" required
                class="block mb-4 p-2.5 outline-none rounded-[14px] w-70 bg-white drop-shadow-lg/40">

            <input type="text" name="kode_barang" placeholder="Kode Barang" required
                class="block mb-4 p-2.5 outline-none rounded-[14px] w-70 bg-white drop-shadow-lg/40">
                
            <label class="mr-36 mb-1.5" for="gambar">Masukkan Gambar</label>

            <input type="file" name="gambar" id="gambar"
                class="block mb-4 p-2.5 outline-none rounded-[14px] w-70 bg-white drop-shadow-lg/40">

            <div class="w-full mt-1 ms-8">
                <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="kategori_id" id="kategori_id"
                    class="block mb-4 p-2.5 outline-none rounded-[14px] w-70 bg-white drop-shadow-lg/40">
                    <option value="" disabled selected>Pilih Kategori</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>


            <button type="submit" class="mt-6 bg-[#377DC2] drop-shadow-lg/40 text-white px-4 py-2 rounded w-50">
                <p style="font-family: 'Nunito', serif; font-weight: 400;">Tambah Barang</p>
            </button>
        </form>
    </div>

</body>

</html>