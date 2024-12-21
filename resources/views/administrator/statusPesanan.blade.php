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
         <div class="text-center mt-6 mb-12">
            <h2 class="text-3xl font-bold text-white">Status Pesanan</h2>
        </div>

        <div class="container mt-4 mx-auto ">
            
            @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                {{ session('success') }}
            </div>
            @endif

            <h1 class="text-xl font-semibold text-white">Daftar Pesanan Masuk</h1>

            <div class="overflow-x-auto shadow rounded-lg mt-6">
    <table class="min-w-full table-auto border-collapse border border-[#7C7C7C]">
        <thead class="bg-[#FFC5C5]">
            <tr>
                <th class="px-4 py-2 text-lg font-semibold text-black border border-[#7C7C7C] text-center">Kode Pesanan</th>
                <th class="px-4 py-2 text-lg font-semibold text-black border border-[#7C7C7C] text-center">Nama Pelanggan</th>
                <th class="px-4 py-2 text-lg font-semibold text-black border border-[#7C7C7C] text-center">Jenis Layanan</th>
                <th class="px-4 py-2 text-lg font-semibold text-black border border-[#7C7C7C] text-center">Berat (kg)</th>
                <th class="px-4 py-2 text-lg font-semibold text-black border border-[#7C7C7C] text-center">Total Harga</th>
                <th class="px-4 py-2 text-lg font-semibold text-black border border-[#7C7C7C] text-center">Tanggal Pesanan</th>
                <th class="px-4 py-2 text-lg font-semibold text-black border border-[#7C7C7C] text-center">Status</th>
            </tr>
        </thead>
        <tbody class="bg-[#F7E9E9]">
            @foreach($pesanans as $pesanan)
                <tr>
                    <td class="px-4 py-2 text-sm border border-[#7C7C7C] text-black text-center">{{ $pesanan->kode_pesanan }}</td>
                    <td class="px-4 py-2 text-sm border border-[#7C7C7C] text-black text-center">{{ $pesanan->nama_pelanggan }}</td>
                    <td class="px-4 py-2 text-sm border border-[#7C7C7C] text-black text-center">{{ $pesanan->layanan->nama_layanan }}</td>
                    <td class="px-4 py-2 text-sm border border-[#7C7C7C] text-black text-center">{{ $pesanan->berat }}</td>
                    <td class="px-4 py-2 text-sm border border-[#7C7C7C] text-black text-center">Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 text-sm border border-[#7C7C7C] text-black text-center">{{ $pesanan->tanggal_pesanan }}</td>
                    <td class="px-4 py-2 text-sm border border-[#7C7C7C] text-black text-center">
    <select
        name="status_pesanan"
        class="p-1 border rounded text-sm 
               {{ $pesanan->status_pesanan === 'selesai' ? 'bg-green-100 text-green-800' : 'bg-white text-gray-800' }}"
        data-id="{{ $pesanan->id_pesanan }}"
        {{ $pesanan->status_pesanan === 'selesai' ? 'disabled' : '' }}
        onchange="updateStatus(this)"
    >
        <option value="diproses" {{ $pesanan->status_pesanan === 'diproses' ? 'selected' : '' }}>Diproses</option>
        <option value="selesai" {{ $pesanan->status_pesanan === 'selesai' ? 'selected' : '' }}>Selesai</option>
    </select>
</td>


                </tr>
            @endforeach
        </tbody>
    </table>
</div>

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

</body>

</html>
