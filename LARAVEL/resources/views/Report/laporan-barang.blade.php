<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Laporan Barang</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-[#12395A] min-h-screen text-black">
    @extends('layouts.app')

    @section('content')
        <div class="w-[90vw] p-6 ml-[18vw]">
            <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between mb-2">
                    <div>
                        <h2 class="text-2xl font-semibold">📝 Laporan Barang</h2>
                        <p class="text-gray-700 mt-1 text-sm">Catatan Log Barang Sarpras</p>
                    </div>
                </div>

                @if ($logs->isEmpty())
                    <div class="bg-yellow-100 text-yellow-800 px-4 py-3 rounded-md mt-4">
                        Tidak ada data log laporan Barang Sarpras.
                    </div>
                @else
                    <div class="space-y-4 mt-4">
                        @foreach ($logs as $log)
                            <div class="bg-[#F1F5F9] rounded-lg shadow p-4 flex items-center border-l-4 border-[#12395A]">
                                <div
                                    class="w-12 h-12 flex items-center justify-center rounded-full bg-[#12395A] text-white font-bold text-lg flex-shrink-0">
                                    {{ $log->id }}
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-800 font-bold">{{ $log->keterangan }}</p>
                                    <p class="text-xs text-gray-500 mt-1">Tanggal:
                                        {{ \Carbon\Carbon::parse($log->created_at)->format('d M Y, H:i') }}</p>
                                </div>
                                <div class="ml-auto">
                                    @if ($log->status === 'input_barang')
                                        <span class="inline-block px-3 py-1 text-sm rounded-full bg-green-200 text-green-800">
                                            Input
                                        </span>
                                    @elseif ($log->status === 'edit_barang')
                                        <span class="inline-block px-3 py-1 text-sm rounded-full bg-orange-200 text-orange-800">
                                            Edit
                                        </span>
                                    @elseif ($log->status === 'hapus_barang')
                                        <span class="inline-block px-3 py-1 text-sm rounded-full bg-red-200 text-red-800">
                                            Hapus
                                        </span>
                                    @else
                                        <span class="inline-block px-3 py-1 text-sm rounded-full bg-gray-200 text-gray-800">
                                            {{ ucfirst($log->status) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        {{ $logs->links() }}
                    </div>
                @endif
            </div>
        </div>
    @endsection

    @include('sweetalert::alert')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>