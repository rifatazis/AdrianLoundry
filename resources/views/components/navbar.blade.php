<nav class="bg-[#001B79]" x-data="{ 
    activeMenu: '{{ request()->routeIs('administrator.HalamanUtamaAdministrator') ? 'administrator.HalamanUtamaAdministrator' 
        : (request()->routeIs('HalamanKelolaLayanan') ? 'HalamanKelolaLayanan' 
        : (request()->routeIs('HalamanTambahPesanan') || request()->routeIs('HalamanUbahStatusPesanan') || request()->routeIs('HalamanLihatStatusPesanan') ? 'pesanan' 
        : (request()->routeIs('HalamanLihatDataPemasukan') || request()->routeIs('HalamanLihatStatistik') ? 'HalamanLihatDataPemasukan' : ''))) }}', 
    isPesananOpen: false, 
    isKeuanganOpen: false, 
    isMenuOpen: false,
    showLogoutModal: false 
}">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">
            <!-- Bagian Kiri -->
            <div class="flex items-center">
                <div class="shrink-0">
                    <a href="{{ route('administrator.HalamanUtamaAdministrator') }}">
                        <img class="w-12 h-12 rounded-full object-cover" src="{{asset ('/images/icon.png') }}" alt="Your Company">
                    </a>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <!-- Tautan Navigasi -->
                        <a href="{{ route('administrator.HalamanUtamaAdministrator') }}" :class="{'bg-gray-900 text-white': activeMenu === 'administrator.HalamanUtamaAdministrator', 'text-gray-300': activeMenu !== 'administrator.HalamanUtamaAdministrator'}"
                            class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700">Halaman Utama</a>
                        <a href="{{ route('HalamanKelolaLayanan') }}" :class="{'bg-gray-900 text-white': activeMenu === 'HalamanKelolaLayanan', 'text-gray-300': activeMenu !== 'HalamanKelolaLayanan'}"
                            class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700">Kelola Layanan</a>
                        <div class="relative" @mouseenter="isPesananOpen = true" @mouseleave="isPesananOpen = false">
                            <a href="#" :class="{'bg-gray-900 text-white': activeMenu === 'pesanan', 'text-gray-300': activeMenu !== 'pesanan'}"
                                class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700 flex items-center">Pesanan</a>
                            <div x-show="isPesananOpen" class="absolute top-full pt-1 w-48 bg-gray-800 rounded-md shadow-lg z-10">
                                <a href="{{ route('HalamanTambahPesanan') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Tambah Pesanan</a>
                                <a href="{{ route('HalamanUbahStatusPesanan') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Ubah Status Pesanan</a>
                                <a href="{{ route('HalamanLihatStatusPesanan') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Lihat Status Pesanan</a>
                            </div>
                        </div>
                        <div class="relative" @mouseenter="isKeuanganOpen = true" @mouseleave="isKeuanganOpen = false">
                            <a href="#" :class="{'bg-gray-900 text-white': activeMenu === 'HalamanLihatDataPemasukan', 'text-gray-300': activeMenu !== 'HalamanLihatDataPemasukan'}"
                                class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700 flex items-center">Keuangan</a>
                            <div x-show="isKeuanganOpen" class="absolute top-full pt-1 w-48 bg-gray-800 rounded-md shadow-lg z-10">
                                <a href="{{ route('HalamanLihatDataPemasukan') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Lihat Data Pemasukan</a>
                                <a href="{{ route('HalamanLihatStatistik') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Lihat Statistik</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bagian Kanan (Logout) -->
            <div class="hidden md:flex items-center space-x-4">
                <button @click="showLogoutModal = true" class="rounded-md px-3 py-2 text-sm font-bold text-gray-300 hover:bg-gray-700 hover:text-white">
                    Logout
                </button>
            </div>

            <!-- Tombol Menu Mobile -->
            <div class="md:hidden">
                <button @click="isMenuOpen = !isMenuOpen" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                    <span class="sr-only">Open main menu</span>
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Logout -->
    <div x-show="showLogoutModal" x-cloak class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
        <div class="bg-white rounded-lg shadow-lg w-96">
            <div class="px-6 py-4">
                <h3 class="text-lg font-semibold text-gray-800">Konfirmasi Logout</h3>
                <p class="text-gray-600 mt-2">Apakah Anda yakin ingin keluar?</p>
            </div>
            <div class="flex justify-end px-6 py-3 space-x-3">
                <button @click="showLogoutModal = false" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400">Batal</button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="md:hidden" x-show="isMenuOpen" x-transition>
        <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
            <a href="{{ route('administrator.HalamanUtamaAdministrator') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md py-2 text-base font-medium">Halaman Utama</a>
            <a href="{{ route('HalamanKelolaLayanan') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md py-2 text-base font-medium">Kelola Layanan</a>
            <a href="{{ route('HalamanTambahPesanan') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md py-2 text-base font-medium">Tambah Pesanan</a>
            <a href="{{ route('HalamanUbahStatusPesanan') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md py-2 text-base font-medium">Ubah Status Pesanan</a>
            <a href="{{ route('HalamanLihatStatusPesanan') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md py-2 text-base font-medium">Lihat Status Pesanan</a>
            <a href="{{ route('HalamanLihatDataPemasukan') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md py-2 text-base font-medium">Keuangan</a>
            <a href="{{ route('HalamanLihatStatistik') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md py-2 text-base font-medium">Lihat Statistik</a>
            <button @click="showLogoutModal = true" class="block w-full text-left px-2 py-2 text-base text-gray-300 hover:bg-gray-700 hover:text-white">Logout</button>
        </div>
    </div>
</nav>
