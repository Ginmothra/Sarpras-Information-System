<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito  ">
    <title>Peminjaman</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-[#12395A] relative h-screen overflow-x-hidden">
   @extends('layouts.app')

@section('content')
    <div class="z-8 p-6 ml-[18vw] w-[90vw]">
        <div class="bg-white rounded-2xl shadow-xl p-6">

            <div class="header flex">
                <h1 class="text-2xl font-bold text-[#12395A] mb-4">Daftar Peminjaman Barang</h1>
                <a href="/dashboard/peminjaman/form"
                    class="ml-auto mb-4 h-10 w-43 bg-[#12395A] text-white rounded-lg hover:bg-[#0f2f4d] transition flex items-center justify-center">
                    Request Peminjaman
                </a>
            </div>

            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="text-xs uppercase bg-blue-100 text-[#12395A]">
                    <tr>
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Gambar</th>
                        <th class="px-6 py-3">Nama Barang</th>
                        <th class="px-6 py-3">Kode Barang</th>
                        <th class="px-6 py-3">Nama Peminjam</th>
                        <th class="px-6 py-3">Tanggal Pengembalian</th>
                        <th class="px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($minjams as $minjam)
                        <tr class="bg-white border-b hover:bg-blue-50 transition">
                            <td class="px-6 py-4 font-medium text-[#12395A]">{{ $minjam->id }}</td>
                            <td class="px-6 py-4">
                                <img width="80" height="80" src="{{ asset($minjam->barang->gambar) }}" alt="Gambar Gagal Di Load">
                            </td>
                            <td class="px-6 py-4 text-gray-800">{{ $minjam->barang->nama }}</td>
                            <td class="px-6 py-4 text-gray-800">{{ $minjam->barang->kode_barang }}</td>
                            <td class="px-6 py-4 text-gray-800">{{ $minjam->siswa->username }}</td>
                            <td class="px-6 py-4 text-gray-800">
                                {{ \Carbon\Carbon::parse($minjam->tanggal_kembali)->format('d-F-Y H:i') }}
                            </td>
                            <td>
                                @if($minjam->status === 'pending')
                                    <span class="inline-block px-3 py-1 text-sm rounded-full bg-gray-200 text-gray-800">
                                        Pending
                                    </span>
                                @elseif($minjam->barang->status === 'terpakai')
                                    <span class="inline-block px-3 py-1 text-sm rounded-full bg-red-100 text-red-800">
                                        Terpakai
                                    </span>
                                @elseif($minjam->status === 'dikembalikan')
                                    <span class="inline-block px-3 py-1 text-sm rounded-full bg-red-100 text-orange-800">
                                        Dikembalikan
                                    </span>
                                @else
                                    <span class="inline-block px-3 py-1 text-sm rounded-full bg-green-100 text-green-800">
                                        Selesai
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $minjams->links() }}
            </div>
        </div>
    </div>
@endsection

@include('sweetalert::alert')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>