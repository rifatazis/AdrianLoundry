<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Tambah Pesanan</title>
</head>

<body class="h-full">

    <div class="min-h-full" x-data="{ open: false }">
        <!-- Navbar -->
        <x-navbar></x-navbar>

        <!-- Header -->
        <x-header>Tambah Pesanan</x-header>

        @if(session('success'))
        <div class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded-md max-w-sm w-full">
                <h2 class="text-xl font-semibold mb-4">Pesanan Berhasil Disimpan!</h2>
                <p>{{ session('success') }}</p>
                <button class="bg-blue-500 text-white py-2 px-4 rounded-md mt-4"
                    onclick="window.location.reload();">OK</button>
            </div>
        </div>
        @endif


        <div class="container mt-4 ml-6">

            <div class="flex items-center justify-between mb-4">
                <h1 class="text-xl font-semibold">Daftar Pesanan Masuk</h1>
                <button type="button" class="bg-blue-500 text-white py-2 px-4 rounded-md mb-[8px]" @click="open = true">
                    Tambah Pesanan
                </button>
            </div>


            @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                {{ session('success') }} - Kode Pesanan: <strong>{{ session('kode_pesanan') }}</strong>
            </div>
            @endif




            <table class="min-w-full table-auto border-collapse border border-gray-200">
                <thead>
                    <tr>
                        <!-- <th class="px-4 py-2 border">ID Pesanan</th> -->
                        <th class="px-4 py-2 border">Kode Pesanan</th>
                        <th class="px-4 py-2 border">Nama Pelanggan</th>
                        <th class="px-4 py-2 border">Jenis Layanan</th>
                        <th class="px-4 py-2 border">Berat (kg)</th>
                        <th class="px-4 py-2 border">Total Harga</th>
                        <th class="px-4 py-2 border">Tanggal Pesanan</th>
                        <!-- <th class="px-4 py-2 border">Status</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($pesanans as $pesanan)
                    <tr>
                        <!-- <td class="px-4 py-2 border">{{ $pesanan->id_pesanan }}</td> -->
                        <td class="px-4 py-2 border">{{ $pesanan->kode_pesanan }}</td>
                        <td class="px-4 py-2 border">{{ $pesanan->user->username ?? 'Pelanggan Baru' }}</td>
                        <td class="px-4 py-2 border">{{ $pesanan->layanan->nama_layanan }}</td>
                        <td class="px-4 py-2 border">{{ $pesanan->berat }}</td>
                        <td class="px-4 py-2 border">Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 border">{{ $pesanan->tanggal_pesanan }}</td>
                        <!-- <td class="px-4 py-2 border">{{ $pesanan->status_pesanan }}</td> -->
                    </tr>
                    @endforeach
                </tbody>
            </table>


            <div x-show="open" x-transition @click.away="open = false"
                class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50">
                <div class="bg-white p-6 rounded-md max-w-sm w-full">
                    <div class="modal-header flex justify-between items-center">
                        <h5 class="modal-title text-xl font-semibold">Tambah Pesanan Baru</h5>
                        <button type="button" class="text-gray-600" @click="open = false">X</button>
                    </div>
                    <div class="modal-body mt-4">
                        <form action="{{ route('tambahPesanan.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="nama_pelanggan" class="block">Nama Pelanggan</label>
                                <input type="text" name="nama_pelanggan" class="w-full p-2 border rounded-md"
                                    placeholder="Nama Pelanggan" required>
                            </div>
                            <div class="mb-4">
                                <label for="id_layanan" class="block">Jenis Layanan</label>
                                <select name="id_layanan" id="id_layanan" class="w-full p-2 border rounded-md" required>
                                    <option value="">Pilih Layanan</option>
                                    @foreach($layanan as $l)
                                    <option value="{{ $l->id_layanan }}" data-harga="{{ $l->harga }}">
                                        {{ $l->nama_layanan }} - Rp{{ number_format($l->harga, 0, ',', '.') }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="berat" class="block">Berat Pesanan (kg)</label>
                                <input type="number" name="berat" id="berat" class="w-full p-2 border rounded-md"
                                    step="0.1" required>
                            </div>
                            <div class="mb-4">
                                <label for="total_harga" class="block">Harga</label>
                                <input type="text" name="total_harga" id="total_harga"
                                    class="w-full p-2 border rounded-md" readonly>
                            </div>
                            <div class="mb-4">
                                <label for="tanggal_pesanan" class="block">Tanggal Pesanan Masuk</label>
                                <input type="date" name="tanggal_pesanan" class="w-full p-2 border rounded-md" required>
                            </div>
                            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script>
document.getElementById('berat').addEventListener('input', updateHarga);
document.getElementById('id_layanan').addEventListener('change', updateHarga);

function updateHarga() {
    const layanan = document.getElementById('id_layanan');
    const berat = document.getElementById('berat').value;
    const hargaPerKg = layanan.options[layanan.selectedIndex]?.dataset.harga || 0;
    const totalHarga = berat * hargaPerKg;
    document.getElementById('total_harga').value = totalHarga ?
        `Rp${new Intl.NumberFormat('id-ID').format(totalHarga)}` : '';
}

document.addEventListener('DOMContentLoaded', function() {
    const inputTanggal = document.querySelector('input[name="tanggal_pesanan"]');
    const today = new Date().toISOString().split('T')[0];
    if (inputTanggal) {
        inputTanggal.value = today;
    }
});
</script>

</html>