<nav class="bg-gray-800"
    x-data="{ activeMenu: '{{ request()->routeIs('halamanUtama') ? 'halamanUtama' 
            : (request()->routeIs('mengelolaLayananDanHarga') ? 'mengelolaLayananDanHarga' 
            : (request()->routeIs('tambahPesanan') || request()->routeIs('statusPesanan') || request()->routeIs('lihatStatusPesanan') ? 'pesanan' 
            : (request()->routeIs('keuangan') || request()->routeIs('statistikKeuangan') ? 'keuangan' : ''))) }}', isPesananOpen: false, isKeuanganOpen: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="shrink-0">
                    <img class="size-8" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500"
                        alt="Your Company">
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
                                <a href="{{ route('tambahPesanan') }}"
                                    class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Tambah Pesanan
                                    Baru</a>
                                <a href="{{ route('statusPesanan') }}"
                                    class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Ubah Status
                                    Pesanan</a>
                                <a href="{{ route('lihatStatusPesanan') }}"
                                    class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Lihat Status
                                    Pesanan</a>
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
                                <a href="{{ route('keuangan') }}"
                                    class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Lihat Data
                                    Pemasukan</a>
                                <a href="{{ route('lihatStatistik') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Lihat
                                    Statistik</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>