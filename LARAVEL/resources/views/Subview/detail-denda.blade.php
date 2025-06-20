<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Denda</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-[#12395A] min-h-screen">
    @extends('layouts.app')

    @section('content')
        <div class="w-[90vw] p-6 ml-[18vw]">
            <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-md p-6 text-black">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-semibold">💰 Detail Denda Siswa</h2>
                </div>

                @if ($dendas->isEmpty())
                    <div class="bg-yellow-100 text-yellow-800 px-4 py-3 rounded-md">
                        Tidak ada data denda untuk siswa ini.
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach ($dendas as $denda)
                            <div
                                class="bg-[#F1F5F9] rounded-lg shadow p-4 flex justify-between items-start border-l-4 border-[#12395A]">
                                <div>
                                    <p class="text-lg font-bold text-[#12395A]">
                                        Rp {{ number_format($denda->jumlah, 0, ',', '.') }}
                                    </p>
                                    <p class="text-sm text-gray-700 mt-1">
                                        @if ($denda->status == 'belum_lunas')
                                            <span class="text-red-600 font-semibold">Belum Dibayar</span>
                                        @else
                                            <span class="text-green-600 font-semibold">Sudah Lunas</span>
                                        @endif
                                    </p>
                                    <p class="text-gray-600 text-sm mt-1">
                                        {{ $denda->keterangan }}
                                    </p>
                                    <p class="text-gray-500 text-xs mt-2">
                                        Dibuat: {{ $denda->created_at->format('d M Y, H:i') }}
                                    </p>
                                </div>
                                @if ($denda->status == 'belum_lunas')
                                <div>
                                    <form action="{{ route('acc.denda', $denda->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="mt-15 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                            Konfirmasi Pembayaran
                                        </button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @endsection

    @include('sweetalert::alert')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>