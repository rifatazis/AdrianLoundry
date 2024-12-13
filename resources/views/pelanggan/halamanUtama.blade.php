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
<body class="h-full">

    <div class="min-h-full" x-data="{ open: false }">
        <!-- Header -->
        <x-header>Cari Pesanan</x-header>

        <div class="container mt-4 ml-6">
            <!-- Form Pencarian Kode Unik -->
            <form action="{{ route('pesanan.carii') }}" method="GET" class="mb-4">
                <input type="text" name="kode_pesanan" placeholder="Masukkan kode unik pesanan" class="p-2 border rounded-md" required>
                <button type="submit" class="p-2 bg-blue-500 text-white rounded-md">Cari</button>
            </form>

            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <h1 class="text-xl font-semibold">Daftar Pesanan Masuk</h1>

            <table class="min-w-full table-auto border-collapse border border-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Kode Pesanan</th>
                        <th class="px-4 py-2 border">Nama Pelanggan</th>
                        <th class="px-4 py-2 border">Jenis Layanan</th>
                        <th class="px-4 py-2 border">Berat (kg)</th>
                        <th class="px-4 py-2 border">Total Harga</th>
                        <th class="px-4 py-2 border">Tanggal Pesanan</th>
                        <th class="px-4 py-2 border">Status</th>
                    </tr>
                </thead>
                <tbody>
                @if(isset($pesanans) && $pesanans->isNotEmpty())
    @foreach($pesanans as $pesanan)
        <tr>
            <td class="px-4 py-2 border">{{ $pesanan->kode_pesanan }}</td>
            <td class="px-4 py-2 border">{{ $pesanan->user->username ?? 'Pelanggan Baru' }}</td>
            <td class="px-4 py-2 border">{{ $pesanan->layanan->nama_layanan }}</td>
            <td class="px-4 py-2 border">{{ $pesanan->berat }}</td>
            <td class="px-4 py-2 border">Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
            <td class="px-4 py-2 border">{{ $pesanan->tanggal_pesanan }}</td>
            <td class="px-4 py-2 border">{{ ucfirst($pesanan->status_pesanan) }}</td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="7" class="px-4 py-2 border text-center">Tidak ada data pesanan.</td>
    </tr>
@endif

                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
