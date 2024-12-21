<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Document</title>
</head>

<body class="min-h-screen bg-cover bg-center bg-no-repeat bg-fixed"
    style="background-image: url('/images/administrator.png');">

    <div class="min-h-full">

        <x-navbar></x-navbar>


        <main class="flex items-center justify-center h-full">
            <div class="w-full max-w-7xl mx-auto">

                <div class="text-center mt-6 mb-12">
                    <h2 class="text-3xl font-bold text-white">Layanan Tersedia</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($layanan as $item)
                        <div>
                            <div class="flex justify-center">
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_layanan }}"
                                    class="rounded-[45px] w-48 h-48 object-cover object-center shadow-sm">
                            </div>
                            <div class="text-center">
                                <h3 class="text-xl text-white font-bold mt-4 ">{{ $item->nama_layanan }}</h3>
                                <p class="text-gray-600  text-white">Harga: Rp
                                    {{ number_format($item->harga, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>

    </div>

</body>

</html>