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

<body class="h-full bg-cover bg-center bg-no-repeat bg-fixed"
    style="background-image: url({{ asset('images/administrator.png') }});">
    <div class="min-h-full " x-data="{ open: false }">
        <!-- Navbar -->
        <x-navbar></x-navbar>

        <!-- Header -->
        <div class="text-center mt-6 mb-12">
            <h2 class="text-3xl font-bold text-white">Data Pemasukan Harian</h2>
        </div>

        <form action="{{ route('HalamanLihatStatistik') }}" method="GET" class="p-4">
            <div class="flex justify-between items-center mb-4">
                <div class="pl-80 text-white">
                <h1 class="text-xl font-semibold text-white">Data Pemasukan Bulan {{ \Carbon\Carbon::createFromFormat('m', $bulan)->format('F') }} Tahun {{ $tahun }}</h1>
                    <div class="mb-4">
                        <h2 class="text-lg font-medium">Total Pemasukan:
                            Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</h2>
                    </div>
                </div>
                <div class="flex items-center space-x-4 pr-80">
                    <!-- Bulan -->
                    <div class="flex-1">
                        <select name="bulan"
                            class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" onchange="this.form.submit()">
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

                    <!-- Tahun -->
                    <div class="flex-1">
                        <input type="number" name="tahun" value="{{ $tahun }}"
                            class="p-2 border border-gray-300 rounded-md w-full " onchange="this.form.submit()">
                    </div>                    
                </div>

            </div>
        </form>

        <!-- Grafik Pemasukan Harian -->
        <div class="p-4 max-w-4xl mx-auto bg-gray-200">
    <canvas id="pemasukanChart" class="w-full h-72"></canvas>
</div>


    </div>

</body>
<script>
    const ctx = document.getElementById('pemasukanChart').getContext('2d');
    let chartType = 'line';

    const pemasukanChart = new Chart(ctx, {
    type: chartType,
    data: {
        labels: @json($labels),
        datasets: [{
            label: 'Pemasukan Harian',
            data: @json($data),
            borderColor: 'green',
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
                    text: 'Tanggal',
                    color: 'black'  
                },
                ticks: {
                    color: 'black'  
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Pemasukan (Rp)',
                    color: 'black'  
                },
                ticks: {
                    stepSize: 10000,
                    beginAtZero: true,
                    max: Math.max(...@json($data)) + 10000,
                    color: 'black' 
                }
            }
        }
    }
});
</script>

</html>