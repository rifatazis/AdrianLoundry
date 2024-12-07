<nav class="bg-gray-800" x-data="{ isOpen: false, activeMenu: '{{ request()->routeIs('dashboard') ? 'dashboard' : (request()->routeIs('mengelolaLayananDanHarga') ? 'mengelolaLayananDanHarga' : (request()->routeIs('tambahPesanan') ? 'tambahPesanan' : (request()->routeIs('statusPesanan') ? 'statusPesanan' : (request() -> routeIs('keuangan') ? 'keuangan': (request() -> routeIs('lihatStatusPesanan') ? 'lihatStatusPesanan':''))))) }}' }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="shrink-0">
                    <img class="size-8" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <!-- Dashboard -->
                        <a href="{{ route('dashboard') }}" 
                            :class="{'bg-gray-900': activeMenu === 'dashboard', 'text-white': activeMenu === 'dashboard', 'text-gray-300': activeMenu !== 'dashboard'}"
                            @click="activeMenu = 'dashboard'"
                            class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700">Dashboard</a>

                        <!-- Mengelola layanan dan harga -->
                        <a href="{{ route('mengelolaLayananDanHarga') }}" 
                            :class="{'bg-gray-900': activeMenu === 'mengelolaLayananDanHarga', 'text-white': activeMenu === 'mengelolaLayananDanHarga', 'text-gray-300': activeMenu !== 'mengelolaLayananDanHarga'}"
                            @click="activeMenu = 'mengelolaLayananDanHarga'"
                            class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700">Mengelola layanan dan harga</a>

                        <!-- Tambah Pesanan -->
                        <a href="{{ route('tambahPesanan') }}" 
                            :class="{'bg-gray-900': activeMenu === 'tambahPesanan', 'text-white': activeMenu === 'tambahPesanan', 'text-gray-300': activeMenu !== 'tambahPesanan'}"
                            @click="activeMenu = 'tambahPesanan'"
                            class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700">Tambah Pesanan</a>

                        <!-- Status Pesanan -->
                        <a href="{{route('statusPesanan') }}" 
                            :class="{'bg-gray-900': activeMenu === 'statusPesanan', 'text-white': activeMenu === 'statusPesanan', 'text-gray-300': activeMenu !== 'statusPesanan'}"
                            @click="activeMenu = 'statusPesanan'"
                            class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700">Status Pesanan</a>

                       <!-- Keuangan -->
                        <a href="{{route('keuangan')}}" 
                            :class="{'bg-gray-900': activeMenu === 'keuangan', 'text-white': activeMenu === 'keuangan', 'text-gray-300': activeMenu !== 'keuangan'}"
                            @click="activeMenu = 'keuangan'"
                            class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700">Keuangan</a>

                        <!-- lihatStatusPesanan -->
                        <a href="{{ route('lihatStatusPesanan') }}" 
    :class="{'bg-gray-900': activeMenu === 'lihatStatusPesanan', 'text-white': activeMenu === 'lihatStatusPesanan', 'text-gray-300': activeMenu !== 'lihatStatusPesanan'}"
    @click="activeMenu = 'lihatStatusPesanan'"
    class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700">Lihat Status Pesanan</a>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="isOpen" id="mobile-menu" class="md:hidden">
        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" 
                :class="{'bg-gray-900': activeMenu === 'dashboard', 'text-white': activeMenu === 'dashboard', 'text-gray-300': activeMenu !== 'dashboard'}"
                @click="activeMenu = 'dashboard'"
                class="block rounded-md px-3 py-2 text-base font-medium hover:bg-gray-700">Dashboard</a>
            <!-- Mengelola layanan dan harga -->
            <a href="{{ route('mengelolaLayananDanHarga') }}" 
                :class="{'bg-gray-900': activeMenu === 'mengelolaLayananDanHarga', 'text-white': activeMenu === 'mengelolaLayananDanHarga', 'text-gray-300': activeMenu !== 'mengelolaLayananDanHarga'}"
                @click="activeMenu = 'mengelolaLayananDanHarga'"
                class="block rounded-md px-3 py-2 text-base font-medium hover:bg-gray-700">Mengelola layanan dan harga</a>
            <!-- Tambah Pesanan -->
            <a href="{{ route('tambahPesanan') }}" 
                :class="{'bg-gray-900': activeMenu === 'tambahPesanan', 'text-white': activeMenu === 'tambahPesanan', 'text-gray-300': activeMenu !== 'tambahPesanan'}"
                @click="activeMenu = 'tambahPesanan'"
                class="block rounded-md px-3 py-2 text-base font-medium hover:bg-gray-700">Tambah Pesanan</a>
            <!-- Status Pesanan -->
            <a href="{{ route('statusPesanan')}}" 
                :class="{'bg-gray-900': activeMenu === 'statusPesanan', 'text-white': activeMenu === 'statusPesanan', 'text-gray-300': activeMenu !== 'statusPesanan'}"
                @click="activeMenu = 'statusPesanan'"
                class="block rounded-md px-3 py-2 text-base font-medium hover:bg-gray-700">Status Pesanan</a>
            <!-- Keuangan -->
            <a href="{{route('keuangan')}}" 
                :class="{'bg-gray-900': activeMenu === 'keuangan', 'text-white': activeMenu === 'keuangan', 'text-gray-300': activeMenu !== 'keuangan'}"
                @click="activeMenu = 'keuangan'"
                class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700">Keuangan</a>

            <!-- lihatStatusPesanan -->
            <a href="{{ route('lihatStatusPesanan') }}" 
    :class="{'bg-gray-900': activeMenu === 'lihatStatusPesanan', 'text-white': activeMenu === 'lihatStatusPesanan', 'text-gray-300': activeMenu !== 'lihatStatusPesanan'}"
    @click="activeMenu = 'lihatStatusPesanan'"
    class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700">Lihat Status Pesanan</a>
        </div>
    </div>
</nav>
