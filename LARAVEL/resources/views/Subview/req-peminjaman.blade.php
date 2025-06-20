<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito  ">
    <title>Request Peminjaman</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-[#12395A] relative h-screen overflow-x-hidden">
    @extends('layouts.app')
    @section('content')
        <div class="z-8 p-6 ml-[18vw] w-[90vw]">
            <div class="bg-white rounded-2xl shadow-xl p-6">

                {{-- button req start --}}
                <div class="header flex">
                    <h1 class="text-2xl font-bold text-[#12395A] mb-4">Daftar Request Peminjaman</h1>
                </div>
                {{-- button req end --}}

                <table class="min-w-full text-sm text-left text-gray-700">
                    <thead class="text-xs uppercase bg-blue-100 text-[#12395A]">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Nama Barang</th>
                            <th class="px-6 py-3">Kode Barang</th>
                            <th class="px-6 py-3">Nama Peminjam</th>
                            <th class="px-6 py-3">Tanggal Peminjaman</th>
                            <th class="px-6 py-3">Tanggal Pengembalian</th>
                            <th class="px-6 py-3">Alasan Peminjaman</th>
                            <th class="px-6 py-3" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjamans as $peminjaman)

                            <tr class="bg-white border-b hover:bg-blue-50 transition">
                                <td class="px-6 py-4 font-medium text-[#12395A]">{{ $peminjaman->id }}</td>
                                <td class="px-6 py-4 text-gray-800">{{ $peminjaman->barang->nama }}</td>
                                <td class="px-6 py-4 font-medium text-[#12395A]">{{ $peminjaman->kode_barang }}</td>
                                <td class="px-6 py-4">{{ $peminjaman->siswa->username }}</td>
                                <td class="px-6 py-4 text-gray-800">{{$peminjaman->tanggal_pinjam->format('d-F-Y H:i') }}</td>
                                <td class="px-6 py-4 text-gray-800">{{ $peminjaman->tanggal_kembali->format('d-F-Y H:i') }}</td>
                                <td class="px-6 py-4">{{ $peminjaman->alasan }}</td>
                                <td class="px-2 py-4">
                                    <form action="{{ route('peminjaman.acc', $peminjaman->id) }}" method="post">
                                        @csrf
                                        <button
                                            class="text-green-800 bg-green-500 hover:bg-green-600 h-[2rem] drop-shadow-lg rounded w-[3rem] transition">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                    </form>
                                </td>
                                <td class="px-2 py-4">
                                    <form id="reject-form-{{ $peminjaman->id }}"
                                        action="{{ route('peminjaman.reject', $peminjaman->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="alasan_penolakan" id="alasan-{{ $peminjaman->id }}">
                                        <button type="button"
                                            class="text-red-800 bg-red-500 hover:bg-red-600 transition h-[2rem] drop-shadow-lg rounded w-[3rem]"
                                            onclick="tolakPeminjaman({{ $peminjaman->id }})">
                                            <i class="fa-solid fa-x"></i>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $peminjamans->links() }}
                </div>
            </div>
        </div>
    @endsection
    @include('sweetalert::alert')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function tolakPeminjaman(id) {
            const alasan = prompt("Tulis alasan penolakan:");

            if (alasan === null) {
                return; 
            }

            if (alasan.trim() === "") {
                alert("Alasan tidak boleh kosong!");
                return;
            }

       
            document.getElementById('alasan-' + id).value = alasan;
            document.getElementById('reject-form-' + id).submit();
        }
    </script>

</body>

</html>