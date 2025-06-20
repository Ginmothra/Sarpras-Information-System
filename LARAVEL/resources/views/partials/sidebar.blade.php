<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
<link rel="stylesheet" href="{{ asset('Css/scrollbar.css') }}">
<div class=" min-h-full h-full bg-white w-[18vw] drop-shadow-xl/60 fixed top-0 z-10 overflow-y-auto overflow-x-hidden scrollbar-hide"
    style="font-family: 'Nunito', sans-serif;">
    <!-- header start -->
    <div class="w-full h-[14vh] flex items-center sticky top-0 bg-white">
        <img src="{{ asset('Assets/logo.png') }}" class="w-auto h-full" alt="">
        <h1 style="font-weight: 900;" class="text-lg font-bold">SISFO SARPRAS</h1>
    </div>
    <!-- header end -->

    <span class="ms-3 mt-3 inline-block text-sm" style="font-weight: 700">Menu</span>

    <!-- menu start -->
    <div class="menu flex flex-col mt-5">

        <!-- menu item Dashboard start -->
        <div
            class="menu-1 w-50 ms-5 h-10 p-2 hover:bg-[#377DC2]/10 rounded-lg flex items-center {{ request()->is('dashboard') ? 'text-blue-600 bg-[#377DC2]/10 rounded-lg' : 'text-black'}}">
            <img src="{{ asset('Assets/dashboard.png') }}" class="w-7 h-auto inline-block">
            <a href="/dashboard" class="ms-4 text-sm font-semibold w-full h-10 flex items-center">Dashboard</a>
        </div>

        <!-- menu item Dashboard end -->
        {{-- menu item data kategori start --}}
        <div
            class="menu-1 w-50 ms-5 h-10 p-2 mt-3 hover:bg-[#377DC2]/10 rounded-lg flex items-center {{ request()->is('dashboard/data-kategori') ? 'text-blue-600 bg-[#377DC2]/10 rounded-lg' : 'text-black'}}">
            <img src="{{ asset('Assets/kategori.png') }}" class="w-7 h-auto inline-block">
            <a href="{{ route('kategori.index') }}" class="ms-4 text-sm font-semibold w-full h-10 flex items-center">Data
                Kategori</a>
        </div>
        {{-- menu item data kategori end --}}
        <!-- menu item Data Barang start -->
        <div
            class="menu-1 w-50 ms-5 h-10 p-2 mt-3 hover:bg-[#377DC2]/10 rounded-lg flex items-center {{ request()->is('dashboard/data-barang') ? 'text-blue-600 bg-[#377DC2]/10 rounded-lg' : 'text-black'}}">
            <img src="{{ asset('Assets/suitcase.png') }}" class="w-7 h-auto inline-block">
            <a href="/dashboard/data-barang" class="ms-4 text-sm font-semibold w-full h-10 flex items-center">Data
                Barang</a>
        </div>
        <!-- menu item Data Barang end -->

        <!-- menu item Peminjaman start -->
        <div
            class="menu-1 w-50 ms-5 h-10 p-2 mt-3 hover:bg-[#377DC2]/10 rounded-lg flex items-center {{ request()->is('dashboard/peminjaman') ? 'text-blue-600 bg-[#377DC2]/10 rounded-lg' : 'text-black'}}">
            <img src="{{ asset('Assets/reverse.png') }}" class="w-7 h-auto inline-block">
            <a href="/dashboard/peminjaman"
                class="ms-4 text-sm font-semibold w-full h-10 flex items-center">Peminjaman</a>
        </div>
        <!-- menu item Peminjaman end -->

        <!-- menu item Pengembalian start -->
        <div
            class="menu-1 w-50 ms-5 h-10 p-2 mt-3 hover:bg-[#377DC2]/10 rounded-lg flex items-center {{ request()->is('dashboard/pengembalian') ? 'text-blue-600 bg-[#377DC2]/10 rounded-lg' : 'text-black'}}">
            <img src="{{ asset('Assets/pengembalian.png') }}" class="w-7 h-auto inline-block">
            <a href="/dashboard/pengembalian"
                class="ms-4 text-sm font-semibold w-full h-10 flex items-center">Pengembalian</a>
        </div>
        <!-- menu item Pengembalian end -->
        
        <!-- menu item Tambah Siswa start -->
        <div class="menu-1 w-50 ms-5 h-10 p-2 mt-3 hover:bg-[#377DC2]/10 rounded-lg flex items-center">
            <img src="{{ asset('Assets/tambah-siswa.png') }}" class="w-7 h-auto inline-block">
            <a href="{{ route('siswa.index') }}" class="ms-4 text-sm font-semibold w-full h-10 flex items-center">Data
                Siswa</a>
        </div>
        <!-- menu item Tambah Siswa end -->
        
        {{-- Denda Start --}}
        <div
            class="menu-1 w-50 ms-5 h-10 p-2 mt-3 hover:bg-[#377DC2]/10 rounded-lg flex items-center {{ request()->is('dashboard/data-denda') ? 'text-blue-600 bg-[#377DC2]/10 rounded-lg' : 'text-black'}}">
            <img src="{{ asset('Assets/Warning.png') }}" class="w-7 h-auto inline-block">
            <a href="/dashboard/data-denda" class="ms-4 text-sm font-semibold w-full h-10 flex items-center"> Data
                Denda</a>
        </div>
        {{-- End Start --}}



        <!-- dropdown laporan start -->
        <div class="relative w-50 ms-5 mt-3">
    <input type="checkbox" id="dropdown" class="hidden peer" />

    <label for="dropdown"
        class="flex items-center text-black font-semibold text-sm p-2 rounded-lg cursor-pointer hover:bg-[#377DC2]/10">
        <div class="flex items-center">
            <img src="{{ asset('Assets/laporan.png') }}" class="w-6 h-auto mr-3" />
            <p class="ms-2">Laporan</p>
        </div>
    </label>

    <svg class="w-4 h-4 absolute right-5 top-3 transition-transform peer-checked:rotate-180"
        fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 9l-7 7-7-7" />
    </svg>

    <div
        class="mt-1 w-max opacity-0 max-h-0 overflow-hidden peer-checked:opacity-100 peer-checked:max-h-96 transition-all duration-300">
        <a href="/laporan/laporan-barang"
        class="block ms-10 p-2 text-sm font-semibold hover:bg-[#377DC2]/10 rounded-lg {{ request()->is('laporan/laporan-barang') ? 'text-blue-600 bg-[#377DC2]/10 rounded-lg' : 'text-black'}}">Laporan Barang</a>
        <a href="/laporan/laporan-denda"
            class="block ms-10 p-2 text-sm font-semibold hover:bg-[#377DC2]/10 rounded-lg {{ request()->is('laporan/laporan-denda') ? 'text-blue-600 bg-[#377DC2]/10 rounded-lg' : 'text-black'}}">Laporan Denda</a>
        <a href="/laporan/laporan-kategori"
            class="block ms-10 p-2 text-sm font-semibold hover:bg-[#377DC2]/10 rounded-lg {{ request()->is('laporan/laporan-kategori') ? 'text-blue-600 bg-[#377DC2]/10 rounded-lg' : 'text-black'}}">Laporan Kategori</a>
        <a href="/laporan/laporan-siswa"
            class="block ms-10 p-2 text-sm font-semibold hover:bg-[#377DC2]/10 rounded-lg {{ request()->is('laporan/laporan-siswa') ? 'text-blue-600 bg-[#377DC2]/10 rounded-lg' : 'text-black'}}">Laporan Siswa</a>
    </div>
</div>



        <!-- dropdown laporan end -->
        <div class="flex w-full p-3 h-fit  ml-3">
            {{-- nama user start --}}
            <div class="h-auto flex">
                <img class="w-8" src="{{ asset('Assets/user.png') }}" alt="">
                <h1 class="m-1">{{ Auth::user()->name}}</h1>
            </div>
            {{-- nama user end --}}
            <!-- menu item Logout start -->
            <div class="ms-27 z-10 w-10 mr-2 h-8 flex hover:bg-red-600/40 rounded-lg">
                <form action="{{ route('logout') }}" method="POST" class="flex">
                    @csrf
                    <button type="submit" class="flex items-center">
                        <img src="{{ asset('Assets/exit.png') }}" alt="" class="w-8 h-auto">
                    </button>
                </form>
            </div>
            <!-- menu item Logout end -->
        </div>
        <!-- menu end -->
    </div>
</div>