<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Data Pemasukan</title>
</head>

<body class="h-full bg-cover bg-center bg-no-repeat bg-fixed"
    style="background-image: url('/images/administrator.png');">
    <div class="min-h-full" x-data="{ open: false }">
        <x-navbar></x-navbar>

        <div class="text-center mt-6 mb-12">
            <h2 class="text-3xl font-bold text-white">Data Pemasukan</h2>
        </div>

        <div class="container mt-4 mx-auto">

            <div class="flex justify-between items-center mb-4">
                <div>
                <h1 class="text-xl font-semibold text-white">Data Pemasukan Bulan {{ \Carbon\Carbon::createFromFormat('m', $bulan)->format('F') }} Tahun {{ $tahun }}</h1>

                    </h1>
                    <div class="mb-4">
                        <h2 class="text-lg font-medium text-white">Total Pemasukan:
                            Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</h2>
                    </div>
                </div>

                <div>
                    <form action="{{ route('data.pemasukan') }}" method="GET" class="flex space-x-4 mb-4">
                        <select name="bulan"
                            class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            onchange="this.form.submit()">
                            <option value="1" {{ $bulan == 1 ? 'selected' : '' }}>January</option>
                            <option value="2" {{ $bulan == 2 ? 'selected' : '' }}>February</option>
                            <option value="3" {{ $bulan == 3 ? 'selected' : '' }}>March</option>
                            <option value="4" {{ $bulan == 4 ? 'selected' : '' }}>April</option>
                            <option value="5" {{ $bulan == 5 ? 'selected' : '' }}>May</option>
                            <option value="6" {{ $bulan == 6 ? 'selected' : '' }}>June</option>
                            <option value="7" {{ $bulan == 7 ? 'selected' : '' }}>July</option>
                            <option value="8" {{ $bulan == 8 ? 'selected' : '' }}>August</option>
                            <option value="9" {{ $bulan == 9 ? 'selected' : '' }}>September</option>
                            <option value="10" {{ $bulan == 10 ? 'selected' : '' }}>October</option>
                            <option value="11" {{ $bulan == 11 ? 'selected' : '' }}>November</option>
                            <option value="12" {{ $bulan == 12 ? 'selected' : '' }}>December</option>
                        </select>
                        <input type="number" name="tahun" value="{{ $tahun }}"
                            class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            onchange="this.form.submit()" />
                    </form>
                </div>
            </div>

            <!-- Table Data Pemasukan -->
            @if($pesanans->isEmpty())
                <div class="text-center text-gray-500 mt-4">
                <p>Belum ada data pemasukan untuk bulan {{ \Carbon\Carbon::createFromFormat('m', $bulan)->format('F') }} tahun {{ $tahun }}.</p>
                </div>
            @else
            <table
                class="min-w-full table-auto border-collapse border border-[#D1D5DB] bg-[#F7E9E9] shadow-md rounded-lg">
                <thead class="bg-[#FFC5C5]">
                    <tr class="text-black text-lg">
                        <th class="px-4 py-2 border border-[#7C7C7C] text-center font-semibold">Tanggal</th>
                        <th class="px-4 py-2 border border-[#7C7C7C] text-center font-semibold">Kode Pesanan</th>
                        <th class="px-4 py-2 border border-[#7C7C7C] text-center font-semibold">Nama Pelanggan</th>
                        <th class="px-4 py-2 border border-[#7C7C7C] text-center font-semibold">Jumlah Pemasukan</th>
                    </tr>
                </thead>
                <tbody class="bg-[#F7E9E9]">
                    @foreach($pesanans as $pesanan)
                        <tr class="text-black">
                            <td class="px-4 py-2 border border-[#7C7C7C] text-center">
                                {{ \Carbon\Carbon::parse($pesanan->tanggal_pesanan)->format('d-m-Y') }}</td>
                            <td class="px-4 py-2 border border-[#7C7C7C] text-center">{{ $pesanan->kode_pesanan }}</td>
                            <td class="px-4 py-2 border border-[#7C7C7C] text-center">
                                {{ $pesanan->user->username ?? 'Pelanggan Baru' }}</td>
                            <td class="px-4 py-2 border border-[#7C7C7C] text-center">
                                Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


            <!-- Pagination -->
            <div class="mt-4">
                {{ $pesanans->links() }}
            </div>
            @endif
        </div>
    </div>

</body>

</html>