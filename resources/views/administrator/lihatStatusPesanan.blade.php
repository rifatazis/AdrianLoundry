<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Status Pesanan</title>
</head>

<body class="h-full bg-cover bg-center bg-no-repeat bg-fixed"
    style="background-image: url('/images/administrator.png');">
    <div class="min-h-full" x-data="{ open: false }">
        <!-- Navbar -->
        <x-navbar></x-navbar>

        <!-- Header -->
        <div class="text-center py-10">
            <h1 class="text-3xl font-bold text-white">Status Pesanan</h1>
            <p class="text-xl text-white mt-2">Dijamin bersih, rapi, dan wangi</p>
        </div>

        <div class="container mx-auto p-6">
            <!-- Form Pencarian -->
            <div class="flex justify-center mb-8">
                <form action="{{ route('pesanan.cari') }}" method="GET" class="w-full max-w-md relative">
                    <input type="text" name="kode_pesanan" placeholder=" Cari Pesanan..."
                        class="w-full p-4 pl-12 pr-16 border rounded-full shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required>
                    <button type="submit" class="absolute left-0 top-1/2 transform -translate-y-1/2 p-2">
                        <img src="{{ asset('images/search.png') }}" alt="Icon" class="w-10 h-10">
                    </button>
                </form>
            </div>


            <!-- Pilihan Layanan -->
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 text-center">
    @forelse($pesanans as $pesanan)
        <div class="p-4 rounded-lg shadow-lg bg-transparent">
            <img src="{{ $pesanan->layanan->gambar ? asset('storage/' . $pesanan->layanan->gambar) : asset('images/default.png') }}"
                alt="{{ $pesanan->layanan->nama_layanan }}"
                class="w-32 h-32 object-cover object-center mx-auto rounded-lg shadow-md">

            <h3 class="font-bold mt-2 text-white">{{ $pesanan->layanan->nama_layanan }}</h3>

            <p class="text-sm text-white">
                {{ $pesanan->berat }} kg - Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}
            </p>

            <p class="text-sm text-gray-500">
                {{ $pesanan->tanggal_pesanan->format('Y-m-d H:i:s') }}
            </p>

            <p class="text-sm text-gray-500">
                <strong>Nama Pelanggan:</strong> {{ $pesanan->nama_pelanggan ?? 'N/A' }}
            </p>

            <p class="text-sm text-gray-500">
                <strong>Kode Pesanan:</strong> {{ $pesanan->kode_pesanan }}
            </p>

            <p class="text-sm font-semibold {{ $pesanan->status_pesanan === 'selesai' ? 'text-green-500' : 'text-yellow-500' }}">
                {{ ucfirst($pesanan->status_pesanan) }}
            </p>
        </div>
    @empty
        <div class="col-span-3 text-center text-white">
            <p>Tidak ada pesanan ditemukan.</p>
        </div>
    @endforelse
</div>



        </div>
    </div>
</body>

</html>