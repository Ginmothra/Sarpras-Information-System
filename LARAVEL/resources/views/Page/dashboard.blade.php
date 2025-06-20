<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-[#12395A] relative h-screen overflow-x-hidden">
    @extends('layouts.app')
    @section('content')
        <div class="w-[90vw] p-6 ml-[18vw]">
            <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 md:mb-0">📊 Dashboard</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 font-medium">Peminjaman Pending</p>
                                <h2 class="text-3xl font-bold text-[#123959] mt-2">{{ $peminjaman }}</h2>
                            </div>
                            <div class="bg-blue-100 p-4 rounded-full">
                                <i class="fas fa-clock text-[#123959] text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 font-medium">Pengembalian Pending</p>
                                <h2 class="text-3xl font-bold text-orange-600 mt-2">{{ $pengembalian }}</h2>
                            </div>
                            <div class="bg-orange-100 p-4 rounded-full">
                                <i class="fas fa-exchange-alt text-orange-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <a href="{{ route('karantina.index') }}" class="block bg-white rounded-lg shadow p-6 border border-gray-200 hover:shadow-lg hover:scale-[1.02] transition duration-300 ease-in-out hover:border-red-400 cursor-pointer transform">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="bg-red-100 p-4 rounded-full">
                                    <i class="fas fa-box-open text-red-600 text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-500 font-medium">Barang Dikarantina</p>
                                    <h2 class="text-3xl font-bold text-red-600 mt-2">{{ $karantina }}</h2>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-chevron-right text-gray-400 text-xl"></i>
                            </div>
                        </div>
                    </a>



                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-6 lg:col-span-2 border border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Top 5 Siswa dengan Hutang Terbanyak</h2>
                        <div class="overflow-x-auto rounded-lg border border-gray-200">
                            <table class="min-w-full bg-white text-sm text-left text-gray-700">
                                <thead class="bg-gray-50 border-b text-xs uppercase text-gray-600">
                                    <tr>
                                        <th class="px-6 py-4">No</th>
                                        <th class="px-6 py-4">Nisn</th>
                                        <th class="px-6 py-4">Nama Siswa</th>
                                        <th class="px-6 py-4">Jumlah Hutang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($topDenda->isEmpty())
                                    <tr>
                                        <td colspan="4">
                                            <div class="bg-yellow-100 text-yellow-800 px-4 py-3 rounded-md mt-4">
                                            belum ada siswa yang memiliki denda
                                            </div>
                                        </td>
                                    </tr>
                                    @else
                                    @foreach ( $topDenda as $index => $denda )
                                    <tr class="hover:bg-gray-50 border-b">
                                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4">{{ $denda->siswa->nisn }}</td>
                                        <td class="px-6 py-4">{{ $denda->siswa->username }}</td>
                                        <td class="px-6 py-4 font-bold text-red-600">{{ number_format($denda->total_denda, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-500 font-medium">Barang Tersedia</p>
                                    <h2 class="text-3xl font-bold text-green-600 mt-2">{{ $tersedia }}</h2>
                                </div>
                                <div class="bg-green-100 p-4 rounded-full">
                                    <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                                </div>
                            </div>
                        </div>
                       
                        <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-500 font-medium">Barang Terpakai</p>
                                    <h2 class="text-3xl font-bold text-yellow-600 mt-2">{{ $terpakai }}</h2>
                                </div>
                                <div class="bg-yellow-100 p-4 rounded-full">
                                    <i class="fas fa-tools text-yellow-600 text-2xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</body>

</html> 