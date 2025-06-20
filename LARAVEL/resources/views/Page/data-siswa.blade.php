<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <title>Data Siswa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-[#12395A] relative h-screen overflow-x-hidden">
    @extends('layouts.app')
    @section('content')
        <div class="w-[90vw] p-6 ml-[18vw]">
            <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 md:mb-0">👨‍🎓 Data Siswa</h2>

                    <div class="flex items-center space-x-5">
                        <form action="{{ route('siswa.search') }}" method="GET">
                            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari Siswa..."
                                class="w-full md:w-64 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#123959]">
                            <button type="submit"
                                class="px-4 py-2 bg-[#123959] text-white rounded-md hover:bg-[#1f2c37] transition">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>

                        <a href="{{ route('siswa.export') }}" class="w-9 h-9 items-center flex justify-center text-green-300 bg-green-700 rounded-md">
                            <i class="fa-solid fa-table"></i>
                        </a>
                        <a href="{{ route('index.siswa.tambah') }}">
                            <button class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-md hover:bg-[#123959] hover:text-white">
                                Tambah Siswa
                            </button>
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full bg-white text-sm text-left text-gray-700">
                        <thead class="bg-gray-50 border-b text-xs uppercase text-gray-600">
                            <tr>
                                <th class="px-6 py-4">NISN</th>
                                <th class="px-6 py-4">Nama</th>
                                <th class="px-6 py-4">Dibuat Saat</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswas as $siswa)
                                <tr class="hover:bg-gray-50 border-b">
                                    <td class="px-6 py-4">{{ $siswa->nisn }}</td>
                                    <td class="px-6 py-4">{{ $siswa->username }}</td>
                                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($siswa->created_at)->format('d-F-Y H:i')  }}</td>
                                    <td class="px-6 py-4 text-center space-x-2">
                                        <a href="{{ route('siswa.edit', $siswa->nisn) }}">
                                            <button class="text-yellow-500 hover:text-yellow-600 transition">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </a>
                                        <form action="{{ route('siswa.delete', $siswa->nisn) }}" method="POST"
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
                    {{ $siswas->links() }}
                </div>
            </div>
        </div>
    @endsection
    @include('sweetalert::alert')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
