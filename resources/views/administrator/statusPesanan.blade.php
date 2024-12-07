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

<body class="h-full">

    <div class="min-h-full" x-data="{ open: false }">
        <!-- Navbar -->
        <x-navbar></x-navbar>

        <!-- Header -->
        <x-header>Status Pesanan</x-header>

        <div class="container mt-4 ml-6">
            
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
                    @foreach($pesanans as $pesanan)
                    <tr>
                        <td class="px-4 py-2 border">{{ $pesanan->kode_pesanan }}</td>
                        <td class="px-4 py-2 border">{{ $pesanan->user->username ?? 'Pelanggan Baru' }}</td>
                        <td class="px-4 py-2 border">{{ $pesanan->layanan->nama_layanan }}</td>
                        <td class="px-4 py-2 border">{{ $pesanan->berat }}</td>
                        <td class="px-4 py-2 border">Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 border">{{ $pesanan->tanggal_pesanan }}</td>
                        <td class="px-4 py-2 border">
                            <select
                                name="status_pesanan"
                                class="p-1 border rounded"
                                data-id="{{ $pesanan->id_pesanan }}"
                                style="background-color: {{ $pesanan->status_pesanan === 'selesai' ? '#d1fae5' : '#ffffff' }}; color: {{ $pesanan->status_pesanan === 'selesai' ? '#065f46' : '#000000' }};"
                                {{ $pesanan->status_pesanan === 'selesai' ? 'disabled' : '' }}
                                onchange="updateStatus(this)"
                            >
                                <option value="diproses" {{ $pesanan->status_pesanan === 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="selesai" {{ $pesanan->status_pesanan === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="dibatalkan" {{ $pesanan->status_pesanan === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

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
                        selectElement.style.backgroundColor = '#d1fae5'; // Hijau muda
                        selectElement.style.color = '#065f46'; // Hijau gelap
                        selectElement.disabled = true; // Nonaktifkan dropdown
                    } else {
                        selectElement.style.backgroundColor = '#ffffff'; // Putih
                        selectElement.style.color = '#000000'; // Hitam
                    }
                } else {
                    alert(data.message || 'Terjadi kesalahan.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>

</body>

</html>
