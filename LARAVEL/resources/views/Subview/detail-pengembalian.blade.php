<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white shadow-xl rounded-2xl w-[70vw] overflow-hidden">
        <div class="md:flex">
            <div class="md:w-1/2">
                <img src="{{ asset($detail->bukti_pengembalian) }}" alt="Foto Barang"
                     class=" object-contain w-full h-full rounded-l-2xl">
            </div>
            <div class="md:w-1/2 p-6">
                <h2 class="text-2xl font-bold mb-2 text-gray-800">{{ $detail->nama_barang . " • " . $detail->kode_barang }}</h2>
                <p class="text-gray-600 mb-2">Nama Pengembali: <span class="font-semibold">{{ $detail->nama_pengembali }}</span></p>
                <p class="text-gray-600 mb-2">Tanggal Pengembalian: <span class="font-semibold">{{ \Carbon\Carbon::parse($detail->created_at)->format('d-F-Y H:i') }}</span></p>
                <p class="text-gray-600 mb-2">Batas Pengembalian: <span class="font-semibold">{{ \Carbon\Carbon::parse($detail->tanggal_pengembalian)->format('d-F-Y H:i') }}</span></p>
                <p class="text-gray-600 mb-2">Kondisi: 
                    @if ( $detail->kondisi_barang === 'baik' )
                    <span class="text-green-600 font-semibold">Baik</span></p>
                    @else
                    <span class="text-red-600 font-semibold">Rusak</span></p>
                    @endif
                <p class="text-sm text-gray-500 mb-2">Catatan: {{ $detail->catatan }}</p>

                <div class="mt-[15vh]">
                    <a href="{{ route('pengembalian.index') }}" class="inline-block">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                            Kembali
                        </button>
                    </a>
                        <form action="{{ route('pengembalian.acc',$detail->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow transition">
                                Konfirmasi
                            </button>
                        </form>
                    <a href="{{ route('form.denda', [$detail->nisn, 'from' => 'pengembalian'])}}" class="inline-block">
                        <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow transition">
                            Denda
                        </button>
                    </a>
                        <form action="{{ route('karantina.input', $detail->id) }}" class="inline-block" method="post">
                            @csrf
                            <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg shadow transition">
                                Karantina
                            </button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
