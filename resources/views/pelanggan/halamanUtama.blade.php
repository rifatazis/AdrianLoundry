<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Halaman Utama</title>
</head>

<body class="h-full bg-cover bg-center bg-no-repeat bg-fixed"
    style="background-image: url('/images/administrator.png');">
    <div class="min-h-full" x-data="{ open: false, showLogoutModal: false }">

        <!-- Header -->
        <header class="bg-gray-800 shadow">
            <div class="container mx-auto flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                <!-- Logo Laundry -->
                <a href="{{ route('halamanUtama') }}" class="flex items-center">
                    <img src="/images/icon.png" alt="Logo Laundry" class="h-12 w-12 rounded-full">
                    <span class="ml-3 text-white text-xl font-bold">Adrian Laundry</span>
                </a>

                <!-- Tombol Logout -->
                <button type="button" @click="showLogoutModal = true"
                    class="bg-red-500 hover:bg-red-600 text-white font-medium px-4 py-2 rounded-md shadow">
                    Logout
                </button>
            </div>
        </header>

        <!-- Modal Logout -->
        <div x-show="showLogoutModal" x-cloak
            class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
            <div class="bg-white rounded-lg shadow-lg w-96">
                <div class="px-6 py-4">
                    <h3 class="text-lg font-semibold text-gray-800">Konfirmasi Logout</h3>
                    <p class="text-gray-600 mt-2">Apakah Anda yakin ingin keluar?</p>
                </div>
                <div class="flex justify-end px-6 py-3 space-x-3">
                    <button @click="showLogoutModal = false"
                        class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400">Batal</button>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Logout</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Konten Utama -->
        <div class="text-center py-10">
            <h1 class="text-3xl font-bold text-white">Cari Pesanan</h1>
            <p class="text-xl text-white mt-2">Dijamin bersih, rapi, dan wangi</p>
        </div>

        @if(session('success'))
        <div class="bg-red-500 text-white p-4 rounded-md mb-4">
            {{ session('success') }}
        </div>
        @endif

        <div class="container mx-auto p-6">
            <!-- Form Pencarian Kode Unik -->
            <div class="flex justify-center mb-8">
                <form action="{{ route('pesanan.carii') }}" method="GET" class="w-full max-w-md relative">
                    <input type="text" name="kode_pesanan" placeholder="Masukkan kode pesanan"
                        class="w-full p-4 pl-14 pr-16 border rounded-full shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required>
                    <button type="submit" class="absolute left-0 top-1/2 transform -translate-y-1/2 p-2">
                        <img src="{{ asset('images/search.png') }}" alt="Icon" class="w-10 h-10">
                    </button>
                </form>
            </div>

            <!-- Daftar Pesanan -->
            <div class="grid grid-cols-1 sm:grid-cols-1 gap-6 text-center">
                @if(isset($pesanans) && $pesanans->isNotEmpty())
                @foreach($pesanans as $pesanan)
                <div class="p-4 rounded-lg shadow-lg bg-transparent">
                    <img src="{{ $pesanan->layanan->gambar ? asset('storage/' . $pesanan->layanan->gambar) : asset('images/default.png') }}"
                        alt="{{ $pesanan->layanan->nama_layanan }}"
                        class="w-32 h-32 object-cover object-center mx-auto rounded-lg shadow-md">

                    <h3 class="font-bold mt-2 text-white">{{ $pesanan->layanan->nama_layanan }}</h3>
                    <h3 class="font-bold mt-2 text-white">{{ $pesanan->layanan->jenis_pakaian }}</h3>

                    <p class="text-sm text-white">
                        {{ $pesanan->berat }} kg - Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}
                    </p>

                    <p class="text-sm text-white">
                        {{ $pesanan->tanggal_pesanan->format('d-m-Y') }}
                    </p>

                    <p class="text-sm text-white">
                        Nama Pelanggan : {{ $pesanan->user->username ?? 'Pelanggan Baru' }}
                    </p>

                    <p class="text-sm text-white">
                        Kode : {{ $pesanan->kode_pesanan }}
                    </p>

                    <p
                        class="text-sm font-semibold {{ $pesanan->status_pesanan === 'selesai' ? 'text-green-500' : 'text-yellow-500' }}">
                        {{ ucfirst($pesanan->status_pesanan) }}
                    </p>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</body>

</html>
