<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <title>Barang Karantina</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-[#12395A] relative h-screen overflow-x-hidden">
    @extends('layouts.app')
    @section('content')
        <div class="w-[90vw] p-6 ml-[18vw]">
            <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 md:mb-0">🛠️ Karantina Barang</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($barangKarantina as $karantina)  
                        <div class="bg-gray-100 rounded-xl shadow-md p-4 flex flex-col items-center text-center">
                            <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $karantina->nama_barang }}</h3>
                            <h4 class="text-lg font-semibold text-gray-800 mb-1">{{ $karantina->kode_barang }}</h4>
                            <p class="text-sm text-gray-600 mb-2">Kondisi: <span class="font-medium text-red-600">{{ $karantina->kondisi_barang }}</span></p>
                            <p class="text-sm text-gray-600 mb-2">Alasan Kerusakan: <span class="font-medium text-red-600">{{ $karantina->alasan_kerusakan }}</span></p>
                            <form action="{{ route('karantina.done', $karantina->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="mt-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 text-sm">
                                    Sudah Diperbaiki
                                </button>
                            </form> 
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endsection

    @include('sweetalert::alert')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
