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
        <x-header>Status Pesanan</x-header>

        <div class="container mt-4 mx-auto p-4">

            <!-- Form Pencarian Kode Unik -->
            <div class="flex justify-end">
                <form action="{{ route('pesanan.cari') }}" method="GET" class="mb-4">
                    <input 
                        type="text" 
                        name="kode_pesanan" 
                        placeholder="Masukkan kode unik pesanan" 
                        class="p-2 border rounded-md"
                        required
                    >
                    <button type="submit" class="p-2 bg-blue-500 text-white rounded-md">Cari</button>
                </form>
            </div>

            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <h1 class="text-xl font-semibold text-white mb-4">Daftar Pesanan Masuk</h1>

            <table class="min-w-full table-auto border-collapse border border-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border text-white">Kode Pesanan</th>
                        <th class="px-4 py-2 border text-white">Nama Pelanggan</th>
                        <th class="px-4 py-2 border text-white">Jenis Layanan</th>
                        <th class="px-4 py-2 border text-white">Berat (kg)</th>
                        <th class="px-4 py-2 border text-white">Total Harga</th>
                        <th class="px-4 py-2 border text-white">Tanggal Pesanan</th>
                        <th class="px-4 py-2 border text-white">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesanans as $pesanan)
                        <tr>
                            <td class="px-4 py-2 border text-white">{{ $pesanan->kode_pesanan }}</td>
                            <td class="px-4 py-2 border text-white">{{ $pesanan->nama_pelanggan }}</td>
                            <td class="px-4 py-2 border text-white">{{ $pesanan->layanan->nama_layanan }}</td>
                            <td class="px-4 py-2 border text-white">{{ $pesanan->berat }}</td>
                            <td class="px-4 py-2 border text-white">Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border text-white">{{ $pesanan->tanggal_pesanan->format('Y-m-d H:i:s') }}</td>
                            <td class="px-4 py-2 border text-white">{{ ucfirst($pesanan->status_pesanan) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-2 text-center border">Tidak ada pesanan ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
