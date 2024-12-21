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

<body class="h-full bg-cover bg-center bg-no-repeat bg-fixed" style="background-image: url('/images/transaksi.png');">

    <div class="min-h-full" x-data="{ open: false }">
        <!-- Navbar -->
        <x-navbar></x-navbar>

        <!-- Header -->
        <div class="text-center mt-6 mb-12">
            <h2 class="text-3xl font-bold text-white">Tambah Pesanan</h2>
        </div>

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


        <div class="container mt-4 mx-auto">

            <div class="flex items-center justify-between mb-4">
                <h1 class="text-xl font-semibold text-white">Daftar Pesanan Masuk</h1>
                <button type="button" class="bg-blue-500 text-white py-2 px-4 rounded-md mb-[8px]" @click="open = true">
                    Tambah Pesanan
                </button>
            </div>

            <div class="overflow-x-auto shadow rounded-lg mt-6">
                <table class="min-w-full table-auto border-collapse border border-black">
                    <thead class="bg-[#FFC5C5]">
                        <tr>
                            <th class="px-4 py-2 text-lg font-semibold text-black border border-[#7C7C7C] text-center">
                                Kode Pesanan</th>
                            <th class="px-4 py-2 text-lg font-semibold text-black border border-[#7C7C7C] text-center">
                                Nama Pelanggan</th>
                            <th class="px-4 py-2 text-lg font-semibold text-black border border-[#7C7C7C] text-center">
                                Jenis Layanan</th>
                            <th class="px-4 py-2 text-lg font-semibold text-black border border-[#7C7C7C] text-center">
                                Berat (kg)</th>
                            <th class="px-4 py-2 text-lg font-semibold text-black border border-[#7C7C7C] text-center">
                                Total Harga</th>
                            <th class="px-4 py-2 text-lg font-semibold text-black border border-[#7C7C7C] text-center">
                                Tanggal Pesanan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-[#F7E9E9]">
                        @foreach($pesanans as $pesanan)
                            <tr>
                                <td class="px-4 py-2 text-sm border border-[#7C7C7C] text-black text-center">
                                    {{ $pesanan->kode_pesanan }}</td>
                                <td class="px-4 py-2 text-sm border border-[#7C7C7C] text-black text-center">
                                    {{ $pesanan->nama_pelanggan }}</td>
                                <td class="px-4 py-2 text-sm border border-[#7C7C7C] text-black text-center">
                                    {{ $pesanan->layanan->nama_layanan }}</td>
                                <td class="px-4 py-2 text-sm border border-[#7C7C7C] text-black text-center">
                                    {{ $pesanan->berat }}</td>
                                <td class="px-4 py-2 text-sm border border-[#7C7C7C] text-black text-center">
                                    Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-2 text-sm border border-[#7C7C7C] text-black text-center">
                                    {{ $pesanan->tanggal_pesanan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>



            <!-- modal -->
            <div x-show="open" x-transition @click.away="open = false"
                class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50">
                <div class="bg-white p-6 rounded-md max-w-sm w-full " 
                style="background-image: url('/images/tambah.png'); background-size: cover; background-position: center;">
                    <div class="modal-header flex justify-between items-center">
                        <h5 class="modal-title text-xl font-semibold">Tambah Pesanan Baru</h5>
                        <button type="button" class="text-black font-bold" @click="open = false">X</button>
                    </div>
                    <div class="modal-body mt-4">
                        <form action="{{ route('tambahPesanan.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="nama_pelanggan" class="block text-white">Nama Pelanggan</label>
                                <input type="text" name="nama_pelanggan" class="w-full p-2 border rounded-md"
                                    placeholder="Nama Pelanggan" required>
                            </div>
                            <div class="mb-4">
                                <label for="id_layanan" class="block text-white">Jenis Layanan</label>
                                <select name="id_layanan" id="id_layanan" class="w-full p-2 border rounded-md" required>
                                    <option value="">Pilih Layanan</option>
                                    @foreach($layanan as $l)
                                        <option value="{{ $l->id_layanan }}" data-harga="{{ $l->harga }}">
                                            {{ $l->nama_layanan }} - Rp{{ number_format($l->harga, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="berat" class="block text-white">Berat Pesanan (kg)</label>
                                <input type="number" name="berat" id="berat" class="w-full p-2 border rounded-md"
                                    step="0.1" required>
                            </div>
                            <div class="mb-4">
                                <label for="total_harga" class="block text-white">Harga</label>
                                <input type="text" name="total_harga" id="total_harga"
                                    class="w-full p-2 border text-black rounded-md" readonly>
                            </div>
                            <div class="mb-4">
                                <label for="tanggal_pesanan" class="block text-white">Tanggal Pesanan Masuk</label>
                                <input type="datetime-local" name="tanggal_pesanan" class="w-full p-2 border rounded-md"
                                    required>
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

    document.addEventListener('DOMContentLoaded', function () {
        const inputTanggal = document.querySelector('input[name="tanggal_pesanan"]');
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');

        const defaultDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;

        if (inputTanggal) {
            inputTanggal.value = defaultDateTime;
        }
    });

</script>

</html>