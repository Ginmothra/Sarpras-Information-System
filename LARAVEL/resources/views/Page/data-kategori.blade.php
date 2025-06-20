<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito  ">
    <title>Data Kategori</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-[#12395A] relative h-screen overflow-x-hidden">
    @extends('layouts.app')
    @section('content')
        <div class="w-[90vw] p-6 ml-[18vw]">
            <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 md:mb-0">🔗 Data Kategori</h2>

                    <div class="flex items-center space-x-5">
                        <button onclick="openForm()"
                            class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-md hover:bg-[#123959] hover:text-white">
                            Tambah Kategori
                        </button>
                    </div>
                </div>

                <x-tambah-kategori></x-tambah-kategori>
                <x-update-kategori></x-update-kategori>
                <!-- Table -->
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full bg-white text-sm text-left text-gray-700">
                        <thead class="bg-gray-50 border-b text-xs uppercase text-gray-600">
                            <tr>
                                <th class="px-6 py-4">id</th>
                                <th class="px-6 py-4">Nama Kategori</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategoris as $kategori)
                                <tr class="hover:bg-gray-50 border-b">
                                    <td class="px-6 py-4">{{ $kategori->id }}</td>
                                    <td class="px-6 py-4">{{ $kategori->nama_kategori }}</td>
                                    <td class="px-6 py-4 text-center space-x-2">
                                            <button onclick="openUpdateForm({{ $kategori->id }}, '{{ $kategori->nama_kategori }}')" class="text-yellow-500 hover:text-yellow-600 transition">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        <form action="{{ route('kategori.delete', $kategori->id) }}" method="POST"
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
                    {{ $kategoris->links() }}
                </div>
            </div>

        </div>
    @endsection
    @include('sweetalert::alert')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function openForm() {
            const modal = document.getElementById('kategoriForm');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0', 'scale-95');
                modal.classList.add('opacity-100', 'scale-100');
            }, 10);
        }

        function closeForm() {
            const modal = document.getElementById('kategoriForm');
            modal.classList.remove('opacity-100', 'scale-100');
            modal.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    </script>
    <script>
        function openUpdateForm(id, nama){
            const modal = document.getElementById('EditKategoriForm');
            document.getElementById('edit_nama_kategori').value = nama;

            const baseRoute = document.getElementById('baseUpdateRoute').value;
            const finalRoute = baseRoute.replace('__ID__', id)
            document.getElementById('formEditKategori').action = finalRoute;
            modal.classList.remove('hidden')
             setTimeout(() => {
                modal.classList.remove('opacity-0', 'scale-95');
                modal.classList.add('opacity-100', 'scale-100');
            }, 10);
        }

        function closeUpdateForm(){
             const modal = document.getElementById('EditKategoriForm');
             modal.classList.remove('opacity-100', 'scale-100');
             modal.classList.add('opacity-0', 'scale-95');
             setTimeout(() => {
                 modal.classList.add('hidden');
             }, 300);
        }   
    </script>
</body>

</html>