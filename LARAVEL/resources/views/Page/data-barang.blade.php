<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito  ">
    <title>Data Barang</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-[#12395A] relative h-screen overflow-x-hidden">
    @extends('layouts.app')
    @section('content')
        <div class="w-[90vw] p-6 ml-[18vw]">
            <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 md:mb-0">📦 Data Barang</h2>

                    <!-- Search Bar -->
                    <div class="flex items-center space-x-5">
                        <form action="{{ route('search.barang') }}" method="GET">
                            <input type="text" name="search" value="{{ $search ?? "" }}" placeholder="Cari Barang..."
                                class="w-full md:w-64 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#123959]">
                            <button type="submit"
                                class="px-4 py-2 bg-[#123959] text-white rounded-md hover:bg-[#1f2c37] transition">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>

                        <!-- Kategori Filter -->
                        <form action="{{ route('filter.barang') }}" method="GET">
                            @csrf
                            <select name="filter" onchange="this.form.submit()"
                                class="px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#123959]">
                                <option value="" disable selected>Semua Kategori</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ request('filter') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                        <a href="{{ route('export.barang') }}"
                            class="w-9 h-9 items-center flex justify-center text-green-300 bg-green-700 rounded-md"><i
                                class="fa-solid fa-table"></i></a>
                        <a href="{{ route('index.tambah-barang') }}">
                            <button
                                class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-md hover:bg-[#123959] hover:text-white">
                                Tambah Barang
                            </button>
                        </a>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full bg-white text-sm text-left text-gray-700">
                        <thead class="bg-gray-50 border-b text-xs uppercase text-gray-600">
                            <tr>
                                <th class="px-6 py-4">id</th>
                                <th class="px-6 py-4">Kode Barang</th>
                                <th class="px-6 py-4">Nama Barang</th>
                                <th class="px-6 py-4">Gambar Barang</th>
                                <th class="px-6 py-4">Kategori</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangs as $barang)
                                <tr class="hover:bg-gray-50 border-b">
                                    <td class="px-6 py-4">{{ $barang->id }}</td>
                                    <td class="px-6 py-4">{{ $barang->kode_barang }}</td>
                                    <td class="px-6 py-4">{{ $barang->nama }}</td>
                                    <td class="px-6 py-4"><img width="80vw" height="80vh" src="{{ asset($barang->gambar) }}"
                                            alt="Gambar Gagal Di Load"></td>
                                    <td class="px-6 py-4">{{ $barang->kategori->nama_kategori }}
                                    </td>
                                    <td class="px-6 py-4 text-center space-x-2">
                                        <a href="{{ route('edit.barang', $barang->id) }}">
                                            <button class="text-yellow-500 hover:text-yellow-600 transition">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </a>
                                        <form action="{{ route('delete.barang', $barang->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus?')" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="text-red-500 hover:text-red-600 transition">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    {{ $barangs->links() }}
                </div>
            </div>

        </div>
    @endsection
    @include('sweetalert::alert')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>