<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito  ">
    <title>Data Denda</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-[#12395A] relative h-screen overflow-x-hidden">
    @extends('layouts.app')
    @section('content')
        <div class="w-[90vw] p-6 ml-[18vw]">
            <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 md:mb-0">💲 Data Denda</h2>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full bg-white text-sm text-left text-gray-700">
                        <thead class="bg-gray-50 border-b text-xs uppercase text-gray-600">
                            <tr>
                                <th class="px-6 py-4">NISN</th>
                                <th class="px-6 py-4">Nama Siswa</th>
                                <th class="px-6 py-4">Total Denda</th>
                                <th class="px-6 py-4 flex items-center justify-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dendas as $siswa)
                                <tr class="hover:bg-gray-50 border-b">
                                    <td class="px-6 py-4">{{ $siswa->nisn }}</td>
                                    <td class="px-6 py-4">{{ $siswa->username }}</td>
                                    <td class="px-6 py-4">{{ 'Rp ' . number_format($siswa->total_denda ?? 0, 0, ',', '.') }}</td>
                                    <td class="flex items-center justify-center gap-4 mt-2">
                                        <a href="{{ route('detail.denda', ['nisn' => $siswa->nisn]) }}"
                                            class="flex items-center justify-start w-fit">
                                            <button type="button"
                                                class="py-2 px-3 text-sm font-medium bg-[#123959] text-white rounded-lg hover:bg-[#223340]">
                                                Detail Denda
                                            </button>
                                        </a>
                                        <a href="{{ route('form.denda', ['nisn' => $siswa->nisn, 'from' => 'denda']) }}"
                                            class="flex items-center justify-start w-fit">
                                            <button type="button"
                                                class="py-2 px-3 text-sm font-medium bg-red-500 hover:bg-red-900 text-white rounded-lg">
                                                Tambah Denda
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    {{ $dendas->links() }}
                </div>
            </div>

        </div>
    @endsection
    @include('sweetalert::alert')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>