                <div id="EditKategoriForm"
                    class="hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 transition-opacity duration-300 opacity-0 scale-95">
                    <div class="bg-white p-6 rounded-lg w-full max-w-sm relative drop-shadow-black/60 border-1 border-black">

                        <form method="POST" id="formEditKategori">
                            @csrf
                            @method('post')
                            <div class="mb-4">
                                <input type="hidden" id="baseUpdateRoute" value="{{ route('kategori.update', ['id' => '__ID__']) }}">
                                <label for="nama_kategori" class="block text-sm font-medium text-gray-700">Nama
                                    Kategori</label>
                                <input type="text" name="nama_kategori" id="edit_nama_kategori"
                                    class="w-full border border-gray-300 rounded px-3 py-2 mt-1" required>
                            </div>
                            <div class="flex justify-end">
                                <button type="button" onclick="closeUpdateForm()" class="mr-2 px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded">
                                    Batal
                                </button>
                                <button type="submit" class="px-4 py-2 bg-[#123959] hover:bg-[#1b2832] text-white rounded">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                