<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <title>Mengelola Layanan</title>
</head>

<body class="h-full">
    <div class="min-h-full" x-data="{ open: false, editLayanan: null }">
        <x-navbar></x-navbar>
        <x-header>Mengelola Layanan</x-header>

        @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('success') }}
        </div>
        @endif

        <main class="container mx-auto py-6">
            <div class="mb-6">
                <button @click="open = true" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600">
                    Tambah Layanan
                </button>
            </div>

            <!-- Modal Tambah Layanan -->
            <div x-show="open" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50" x-cloak>
                <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                    <h2 class="text-2xl mb-4">Tambah Layanan</h2>
                    <form action="{{ route('layanan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="nama_layanan" class="block text-sm font-semibold">Nama Layanan</label>
                            <input type="text" id="nama_layanan" name="nama_layanan"
                                class="w-full border px-4 py-2 rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="harga" class="block text-sm font-semibold">Harga</label>
                            <input type="number" id="harga" name="harga" class="w-full border px-4 py-2 rounded"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="gambar" class="block text-sm font-semibold">Gambar</label>
                            <input type="file" id="gambar" name="gambar" class="w-full border px-4 py-2 rounded">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Simpan</button>
                            <button @click="open = false" type="button"
                                class="bg-gray-500 text-white px-4 py-2 rounded">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Edit Layanan -->
            <div x-show="editLayanan" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50" x-cloak>
                <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                    <h2 class="text-2xl mb-4">Edit Layanan</h2>
                    <form x-bind:action="'{{ url('layanan') }}/' + editLayanan.id_layanan" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="nama_layanan" class="block text-sm font-semibold">Nama Layanan</label>
                            <input type="text" id="nama_layanan" name="nama_layanan" :value="editLayanan.nama_layanan"
                                class="w-full border px-4 py-2 rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="harga" class="block text-sm font-semibold">Harga</label>
                            <input type="number" id="harga" name="harga" :value="editLayanan.harga"
                                class="w-full border px-4 py-2 rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="gambar" class="block text-sm font-semibold">Gambar</label>
                            <input type="file" id="gambar" name="gambar" class="w-full border px-4 py-2 rounded">
                            <img x-bind:src="editLayanan && editLayanan.gambar ? '{{ asset('storage') }}/' + editLayanan.gambar : ''"
                                alt="Gambar Layanan" class="w-16 h-16 object-cover rounded"
                                x-show="editLayanan && editLayanan.gambar">
                            <p x-show="!editLayanan || !editLayanan.gambar" class="text-gray-500">Tidak ada gambar yang
                                diupload.</p>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Simpan</button>
                            <button @click="editLayanan = null" type="button"
                                class="bg-gray-500 text-white px-4 py-2 rounded">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabel Layanan -->
            <div class="overflow-x-auto bg-white shadow rounded-lg mt-6">
                <table class="min-w-full table-auto text-center">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-2 text-sm font-semibold text-gray-600">No</th>
                            <th class="px-6 py-2 text-sm font-semibold text-gray-600">Nama Layanan</th>
                            <th class="px-6 py-2 text-sm font-semibold text-gray-600">Harga</th>
                            <th class="px-6 py-2 text-sm font-semibold text-gray-600">Gambar</th>
                            <th class="px-6 py-2 text-sm font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($layanan as $index => $item)
                        <tr>
                            <td class="px-6 py-2 text-sm">{{ $index + 1 }}</td>
                            <td class="px-6 py-2 text-sm">{{ $item->nama_layanan }}</td>
                            <td class="px-6 py-2 text-sm">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-2">
                                @if($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar Layanan" class="w-16 h-16 object-cover rounded mx-auto">
                                @else
                                <p class="text-gray-500">Tidak ada gambar</p>
                                @endif
                            </td>
                            <td class="px-6 py-2">
                                <!-- Konfirmasi Penghapusan -->
                                <button @click="if(confirm('Apakah Anda yakin ingin menghapus layanan ini?')) { window.location = '{{ route('layanan.destroy', $item->id_layanan) }}' }"
                                    class="bg-red-500 text-white px-4 py-2 rounded mr-2">Hapus</button>
                                <button @click="editLayanan = {{ $item }}" class="bg-yellow-500 text-white px-4 py-2 rounded mr-2">Edit</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>

</html>
