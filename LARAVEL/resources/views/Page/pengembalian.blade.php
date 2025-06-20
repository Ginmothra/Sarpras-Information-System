<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito  ">
    <title>Pengembalian</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-[#12395A] relative h-screen overflow-x-hidden">
   @extends('layouts.app')

@section('content')
<div class="z-8 p-6 ml-[18vw] w-[90vw]">
    <div class="bg-white rounded-2xl shadow-xl p-6">

        <div class="header flex items-center justify-between">
            <h1 class="text-2xl font-bold text-[#12395A] mb-4">Daftar Pengembalian Barang</h1>
        </div>

        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="text-xs uppercase bg-blue-100 text-[#12395A]">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama Pengembali</th>
                    <th class="px-6 py-3">Nama Barang</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengembalians as $pengembalian)
                <tr class="bg-white border-b hover:bg-blue-50 transition">
                    <td class="px-6 py-4 font-medium text-[#12395A]">{{ $pengembalian->id }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $pengembalian->nama_pengembali }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $pengembalian->nama_barang }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('pengembalian.detail', $pengembalian->id) }}">
                            <button type="button" class="py-2 px-3 text-sm font-medium bg-[#123959] text-white rounded-lg hover:bg-[#223340]">
                                Detail Barang
                            </button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $pengembalians->links() }}
        </div>
    </div>
</div>
@endsection

@include('sweetalert::alert')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>