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

<body class="min-h-screen bg-cover bg-center bg-no-repeat bg-fixed"
    style="background-image: url({{ asset('images/transaksi.png') }});">
    <div class="min-h-full" x-data="{ open: false }">
        <!-- Navbar -->
        <x-navbar></x-navbar>

        <!-- Header -->
        <div class="text-center py-10">
            <h1 class="text-3xl font-bold text-white">Status Pesanan</h1>
        </div>

        @if(isset($error))
            <div class="flex justify-center items-center">
                <div class="bg-red-500 text-white text-sm p-3 rounded-lg shadow-md inline-block">
                {{ $error }}
                </div>
            </div>
        @endif

        <!-- Menampilkan Pesanan -->
        <div class="container mx-auto p-6">
            <!-- Form Pencarian -->
            <div class="flex justify-center mb-8">
                <form action="{{ route('pesanan.cari') }}" method="GET" class="w-full max-w-md relative">
                    <input type="text" name="kode_pesanan" placeholder=" Cari Pesanan..."
                        class="w-full p-4 pl-12 pr-16 border rounded-full shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                        style="text-transform: uppercase;" required>
                    <button type="submit" class="absolute right-0 top-1/2 transform -translate-y-1/2 p-2">
                        <img src="{{ asset('images/search.png') }}" alt="Icon" class="w-10 h-10">
                    </button>
                </form>
            </div>

            <!-- Daftar Pesanan -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @if(isset($pesanans) && $pesanans->isNotEmpty())
                    @foreach($pesanans as $pesanan)
                        <div class="p-6 rounded-lg shadow-xl bg-gray hover:shadow-2xl transition-all duration-300 ease-in-out flex items-center">
                            <img src="{{ $pesanan->layanan->gambar ? asset('storage/' . $pesanan->layanan->gambar) : asset('images/default.png') }}"
                                 alt="{{ $pesanan->layanan->nama_layanan }}"
                                 class="w-32 h-32 object-cover object-center rounded-full border-4 border-gray-200 shadow-md mr-6">
                            <div class="flex-1">
                                <p class="text-gray-800 text-sm mb-2 font-semibold">{{ $pesanan->layanan->nama_layanan }}</p>
                                <p class="text-gray-800 text-sm mb-2 font-semibold">{{ $pesanan->layanan->jenis }}</p>
                                <p class="text-gray-800 text-sm mb-2 font-semibold">{{ $pesanan->berat }} kg -
                                    Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                                <p class="text-gray-800 text-sm mb-2 font-semibold">
                                    {{ $pesanan->tanggal_pesanan->format('d F Y') }}
                                </p>
                                <p class="text-gray-800 text-sm mb-2 font-semibold">{{ $pesanan->nama_pelanggan ?? 'N/A' }}</p>
                                <p class="text-gray-800 text-sm mb-2 font-semibold">Kode Pesanan : {{ $pesanan->kode_pesanan }}</p>
                                <p class="text-sm font-semibold 
                                    {{ $pesanan->status_pesanan === 'selesai' ? 'text-white bg-green-500' : 'text-white bg-yellow-500' }} 
                                    mt-4 px-3 py-1 rounded-full inline-block">
                                    {{ ucfirst($pesanan->status_pesanan) }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
    </div>
</body>

</html>
