<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Data Pemasukan Harian</title>
</head>

<body class="h-full" style="background-image: url('/images/administrator.png'); background-size: cover; background-position: center; background-repeat: no-repeat;">

    <div class="min-h-full" x-data="{ open: false }">
        <!-- Navbar -->
        <x-navbar></x-navbar>

        <!-- Header -->
        <x-header>Data Pemasukan Harian</x-header>

        <form action="{{ route('lihatStatistik') }}" method="GET" class="p-4">
            <div class="flex space-x-4">
                <div>
                    <label for="bulan" class="block text-sm font-medium text-gray-700">Bulan:</label>
                    <select name="bulan"
                        class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
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
                </div>
                <div>
                    <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun:</label>
                    <input type="number" name="tahun" value="{{ $tahun }}"
                        class="mt-1 p-2 border border-gray-300 rounded-md">
                </div>
                <button type="submit" class="mt-6 p-2 bg-blue-500 text-white rounded-md">Tampilkan</button>
            </div>
        </form>

        <!-- Grafik Pemasukan Harian -->
        <div class="p-4">
            <canvas id="pemasukanChart"></canvas>
        </div>

      <script>
    const ctx = document.getElementById('pemasukanChart').getContext('2d');
    const pemasukanChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Pemasukan Harian',
                data: @json($data),
                borderColor: 'rgb(75, 192, 192)',
                fill: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Tanggal'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Pemasukan (IDR)'
                    },
                    ticks: {
                        stepSize: 10000,
                        beginAtZero: true,
                        max: Math.max(...@json($data)) + 10000,
                    }
                }
            }
        }
    });
</script>



    </div>

</body>

</html>