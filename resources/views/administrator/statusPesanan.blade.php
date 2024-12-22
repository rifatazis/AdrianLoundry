<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Status Pesanan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="min-h-screen bg-cover bg-center bg-no-repeat bg-fixed"
style="background-image: url('/images/transaksi.png');">
    <div class="min-h-full" x-data="{ open: false }">
        <!-- Navbar -->
        <x-navbar></x-navbar>

        <!-- Header -->
        <div class="text-center mt-6 mb-12">
            <h2 class="text-3xl font-bold text-white">Status Pesanan</h2>
        </div>

        <div class="container mt-4 mx-auto">

            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <h1 class="text-xl font-semibold text-white">Daftar Pesanan Masuk</h1>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center mt-6">
                @forelse($pesanans as $pesanan)
                    <div class="p-4 rounded-lg shadow-xl bg-white border border-gray-300 relative">
                        <div class="absolute top-5 right-5 w-32 h-10 flex items-center justify-center z-10">
                        <select name="status_pesanan"
                            class="text-sm font-semibold py-1 px-3 uppercase w-full h-full flex items-center justify-center rounded-md
                                {{ $pesanan->status_pesanan === 'selesai' ? 'bg-green-100 text-green-800' : 'bg-gray-500 text-white' }}"
                            data-id="{{ $pesanan->id_pesanan }}"
                            {{ $pesanan->status_pesanan === 'selesai' ? 'disabled' : '' }}
                            onchange="updateStatus(this)">
                        <option value="diproses" {{ $pesanan->status_pesanan === 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ $pesanan->status_pesanan === 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>

                        </div>

                        <div class="relative left-6 text-left">
                            <h3 class="text-black font-bold text-2xl">{{ $pesanan->nama_pelanggan ?? 'N/A' }}</h3>
                            <p class="text-black font-bold text-lg">Customer</p>
                        </div>

                        <div class="my-3 witdh-full border-t border-black"></div>

                        <p class="text-red-500 font-bold text-lg mt-3 text-left">{{ $pesanan->kode_pesanan }}</p>

                        <div class="mt-3">
                            <p class="flex text-gray-800 text-sm mb-3">
                                <span class="w-48 text-left font-medium">Jenis Layanan:</span>
                                <span class="font-bold">{{ $pesanan->layanan->nama_layanan }}</span>
                            </p>
                            <p class="flex text-gray-800 text-sm mb-3">
                                <span class="w-48 text-left font-medium">Jenis Pakaian:</span>
                                <span class="font-bold">{{ $pesanan->layanan->jenis_pakaian }}</span>
                            </p>
                            <p class="flex text-gray-800 text-sm mb-3">
                                <span class="w-48 text-left font-medium">Harga Pesanan:</span>
                                <span class="font-bold">Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                            </p>
                            <p class="flex text-gray-800 text-sm mb-3">
                                <span class="w-48 text-left font-medium">Tanggal Pesanan Masuk:</span>
                                <span class="font-bold">{{ $pesanan->tanggal_pesanan->format('d F Y') }}</span>
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 text-center text-gray-800">
                        <p>Tidak ada pesanan ditemukan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div> 

</body>
<script>
        function updateStatus(selectElement) {
            const status = selectElement.value;
            const idPesanan = selectElement.getAttribute('data-id');
            
            fetch(`/pesanan/${idPesanan}/ubah-status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ status_pesanan: status }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (status === 'selesai') {
                        selectElement.style.backgroundColor = '#d1fae5';
                        selectElement.style.color = '#065f46'; 
                        selectElement.disabled = true; 
                    } else {
                        selectElement.style.backgroundColor = '#ffffff'; 
                        selectElement.style.color = '#000000'; 
                    }
                } else {
                    alert(data.message || 'Terjadi kesalahan.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</html>
