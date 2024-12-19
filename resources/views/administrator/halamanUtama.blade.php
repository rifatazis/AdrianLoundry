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
<body class="h-auto bg-cover bg-center bg-no-repeat bg-fixed"
      style="background-image: url('/images/administrator.png');">
<div class="min-h-full">

  <x-navbar></x-navbar>
  
  <x-header>Layanan Tersedia</x-header>

  <main class="flex items-center justify-center h-full">
      <div class="w-full max-w-7xl mx-auto">
          
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
              @foreach ($layanan as $item)
                  <div class="bg-white p-6 rounded-lg shadow-lg">
                      <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_layanan }}" class="w-full h-48 object-cover rounded-t-lg">
                      <h3 class="text-xl font-bold mt-4">{{ $item->nama_layanan }}</h3>
                      <p class="text-gray-600 mt-2">Harga: Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                  </div>
              @endforeach
          </div>
      </div>
  </main>

</div>

</body>
</html>
