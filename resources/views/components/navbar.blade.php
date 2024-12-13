<nav class="bg-gray-800" x-data="{ activeMenu: '{{ request()->routeIs('halamanUtama') ? 'halamanUtama' 
            : (request()->routeIs('mengelolaLayananDanHarga') ? 'mengelolaLayananDanHarga' 
            : (request()->routeIs('tambahPesanan') || request()->routeIs('statusPesanan') || request()->routeIs('lihatStatusPesanan') ? 'pesanan' 
            : (request()->routeIs('keuangan') || request()->routeIs('statistikKeuangan') ? 'keuangan' : ''))) }}', isPesananOpen: false, isKeuanganOpen: false, isMenuOpen: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="shrink-0">
                <img class="w-12 h-12 rounded-full" src="/images/icon.png" alt="Your Company">
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <!-- Halaman Utama -->
                        <a href="{{ route('halamanUtama') }}"
                            :class="{'bg-gray-900 text-white': activeMenu === 'halamanUtama', 'text-gray-300': activeMenu !== 'halamanUtama'}"
                            class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700">Halaman Utama</a>

                        <!-- Kelola Layanan -->
                        <a href="{{ route('mengelolaLayananDanHarga') }}"
                            :class="{'bg-gray-900 text-white': activeMenu === 'mengelolaLayananDanHarga', 'text-gray-300': activeMenu !== 'mengelolaLayananDanHarga'}"
                            class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700">Kelola Layanan</a>

                        <!-- Pesanan Dropdown -->
                        <div class="relative" @mouseenter="isPesananOpen = true" @mouseleave="isPesananOpen = false">
                            <a href="{{ route('tambahPesanan') }}"
                                :class="{'bg-gray-900 text-white': activeMenu === 'pesanan', 'text-gray-300': activeMenu !== 'pesanan'}"
                                class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700 flex items-center">
                                Pesanan
                            </a>
                            <!-- Dropdown Menu -->
                            <div x-show="isPesananOpen"
                                class="absolute top-full pt-1 w-48 bg-gray-800 rounded-md shadow-lg z-10">
                                <a href="{{ route('tambahPesanan') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Tambah Pesanan Baru</a>
                                <a href="{{ route('statusPesanan') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Ubah Status Pesanan</a>
                                <a href="{{ route('lihatStatusPesanan') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Lihat Status Pesanan</a>
                            </div>
                        </div>

                        <!-- Keuangan Dropdown -->
                        <div class="relative" @mouseenter="isKeuanganOpen = true" @mouseleave="isKeuanganOpen = false">
                            <a href="{{ route('keuangan') }}"
                                :class="{'bg-gray-900 text-white': activeMenu === 'keuangan', 'text-gray-300': activeMenu !== 'keuangan'}"
                                class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700 flex items-center">
                                Keuangan
                            </a>
                            <!-- Dropdown Menu -->
                            <div x-show="isKeuanganOpen"
                                class="absolute top-full pt-1 w-48 bg-gray-800 rounded-md shadow-lg z-10">
                                <a href="{{ route('keuangan') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Lihat Data Pemasukan</a>
                                <a href="{{ route('lihatStatistik') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Lihat Statistik</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button @click="isMenuOpen = !isMenuOpen" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden" x-show="isMenuOpen" x-transition>
        <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
            <a href="{{ route('halamanUtama') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md py-2 text-base font-medium">Halaman Utama</a>
            <a href="{{ route('mengelolaLayananDanHarga') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md py-2 text-base font-medium">Kelola Layanan</a>
            <a href="{{ route('tambahPesanan') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md py-2 text-base font-medium">Tambah Pesanan</a>
            <a href="{{ route('statusPesanan') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md py-2 text-base font-medium">Ubah Status Pesanan</a>
            <a href="{{ route('lihatStatusPesanan') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md py-2 text-base font-medium">Lihat Status Pesanan</a>
            <a href="{{ route('keuangan') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md py-2 text-base font-medium">Keuangan</a>
            <a href="{{ route('lihatStatistik') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md py-2 text-base font-medium">Keuangan</a>
        </div>
    </div>
</nav>
