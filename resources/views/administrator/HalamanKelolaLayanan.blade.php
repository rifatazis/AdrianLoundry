<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <title>Kelola Layanan</title>
</head>

<body class="min-h-screen bg-cover bg-center bg-no-repeat bg-fixed "
    style="background-image: url({{ asset('images/administrator.png') }}); overflow: hidden;">
    <div class="min-h-full" x-data="{ open: false, editLayanan: null, confirmDelete: null, deleteUrl: '' }">

        <x-navbar></x-navbar>

        <div class="text-center mt-6 mb-4">
            <h2 class="text-3xl font-bold text-white">Layanan Tersedia</h2>
        </div>

        @if (session('success'))
            <div id="successNotification"
                class="fixed top-40 left-1/2 transform -translate-x-1/2 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-lg z-50">
                {{ session('success') }}
            </div>
        @endif


        <main class="container mx-auto py-6">
            <div class="mb-3 flex justify-end">
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
                <div class="p-6 rounded-lg shadow-lg w-1/3"
                    style="background-image: url('{{ asset('images/tambah.png') }}'); background-size: cover; background-position: center;">
                    <h2 class="text-2xl mb-4 text-white">Tambah Layanan</h2>
                    <form action="{{ route('layanan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="nama_layanan" class="block text-sm font-semibold text-white">Nama
                                Layanan</label>
                            <input type="text" id="nama_layanan" name="nama_layanan"
                                class="w-full border px-4 py-2 rounded" style="text-transform: uppercase;" required>
                        </div>
                        <div class="mb-4">
                            <label for="jenis" class="block text-sm font-semibold text-white">Jenis
                                </label>
                            <input type="text" id="jenis" name="jenis"
                                class="w-full border px-4 py-2 rounded" style="text-transform: uppercase;" required>
                        </div>
                        <div class="mb-4">
                            <label for="harga" class="block text-sm font-semibold text-white">Harga</label>
                            <input type="number" id="harga" name="harga" style="text-transform: uppercase;" class="w-full border px-4 py-2 rounded"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="gambar" class="block text-sm font-semibold text-white">Gambar</label>
                            <input type="file" id="gambar" name="gambar"  class="w-full border px-4 py-2 rounded">
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
                <div class="bg-white p-6 rounded-lg shadow-lg w-1/3"
                    style="background-image: url('{{ asset('images/tambah.png') }}'); background-size: cover; background-position: center;">
                    <h2 class="text-2xl text-white mb-4">Ubah Layanan</h2>
                    <form x-bind:action="'{{ url('layanan') }}/' + editLayanan.id_layanan" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="nama_layanan" class="block text-sm font-semibold text-white">Nama
                                Layanan</label>
                            <input type="text" id="nama_layanan" name="nama_layanan" :value="editLayanan . nama_layanan"
                                class="w-full border px-4 py-2 rounded" style="text-transform: uppercase;" required>
                        </div>
                        <div class="mb-4">
                            <label for="jenis" class="block text-sm font-semibold text-white">Jenis
                                </label>
                            <input type="text" id="jenis" name="jenis" :value="editLayanan . jenis"
                                class="w-full border px-4 py-2 rounded" style="text-transform: uppercase;" required>
                        </div>
                        <div class="mb-4">
                            <label for="harga" class="block text-sm text-white font-semibold">Harga</label>
                            <input type="number" id="harga" name="harga" :value="editLayanan . harga"
                                class="w-full border px-4 py-2 rounded" style="text-transform: uppercase;" required>
                        </div>
                        <div class="mb-4">
                            <label for="gambar" class="block text-sm text-white font-semibold">Gambar</label>
                            <input type="file" id="gambar" name="gambar" class="w-full border px-4 py-2 rounded">
                            <img x-bind:src="editLayanan && editLayanan.gambar ? '{{ asset('storage') }}/' + editLayanan.gambar : ''"
                                alt="Gambar Layanan" class="w-20 h-20 object-cover rounded mt-3"
                                x-show="editLayanan && editLayanan.gambar">
                            <p x-show="!editLayanan || !editLayanan.gambar" class="text-gray-500 ">Tidak ada gambar yang
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

            <!-- Modal Konfirmasi Hapus -->
            <div x-show="confirmDelete" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90"
                class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50" x-cloak>
                <div class="bg-white rounded-lg p-6 shadow-lg w-1/3 flex flex-col items-center justify-center">
                    <!-- Gambar -->
                    <img src="{{ asset('images/warning.png') }}" alt="Konfirmasi Hapus"
                        class="w-24 h-24 mb-4 object-cover rounded-full">
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Yakin Hapus?</h2>

                    <div class="flex justify-center space-x-4">
                        <button @click="confirmDelete = null"
                            class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Batal</button>
                        <form :action="deleteUrl" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600">Hapus</button>
                        </form>
                    </div>
                </div>

            </div>


            <!-- Tabel Layanan -->
            <div class="shadow rounded-lg ">
                <table class="min-w-full table-auto border-collapse border border-black"
                    style="table-layout: auto; width: 100%;">
                    <thead class="bg-[#FFC5C5]">
                        <tr>
                            <th class="px-4 py-2 text-lg font-semibold text-black border border-[#7C7C7C] text-center">
                                No</th>
                            <th class="px-4 py-2 text-lg font-semibold text-black border border-[#7C7C7C] text-center">
                                Nama Layanan</th>
                            <th class="px-4 py-2 text-lg font-semibold text-black border border-[#7C7C7C] text-center">
                                Jenis</th>
                            <th class="px-4 py-2 text-lg font-semibold text-black border border-[#7C7C7C] text-center">
                                Harga</th>
                            <th class="px-4 py-2 text-lg font-semibold text-black border border-[#7C7C7C] text-center">
                                Gambar</th>
                            <th class="px-4 py-2 text-lg font-semibold text-black border border-[#7C7C7C] text-center">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-[#F7E9E9]">
                        @foreach ($layanan as $index => $item)
                            <tr>
                                <td class="px-4 py-2 text-sm border border-[#7C7C7C] text-black text-center"
                                style="text-transform: uppercase;">
                                    {{ $layanan->firstItem() + $index }}
                                </td>
                                <td class="px-4 py-2 text-sm border border-[#7C7C7C] text-black text-center"
                                style="text-transform: uppercase;">
                                    {{ $item->nama_layanan }}
                                </td>
                                <td class="px-4 py-2 text-sm border border-[#7C7C7C] text-black text-center"
                                style="text-transform: uppercase;">
                                    {{ $item->jenis }}
                                </td>
                                <td class="px-4 py-2 text-sm border border-[#7C7C7C] text-black text-center">
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-2 border border-[#7C7C7C] text-black text-center">
                                    @if ($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar Layanan"
                                            class="w-16 h-16 object-cover rounded mx-auto">
                                    @else
                                        <p class="text-gray-500">Tidak ada gambar</p>
                                    @endif
                                </td>
                                <td class="px-2 py-2 border border-[#7C7C7C] text-white text-center">
                                    <button @click="editLayanan = {{ $item }}"
                                        class="bg-yellow-500 text-white px-3 py-2 rounded mr-2">Ubah</button>
                                    <button
                                        @click="confirmDelete = true; deleteUrl = '{{ route('layanan.destroy', $item->id_layanan) }}'"
                                        class="bg-red-500 text-white px-3 py-2 rounded">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            <nav aria-label="Page navigation" class="mt-3">
                <ul class="flex justify-center items-center space-x-2">
                    <li>
                        <button
                            class="px-3 py-1 rounded border {{ $layanan->onFirstPage() ? 'bg-gray-300 text-gray-500 cursor-not-allowed' : 'bg-white text-blue-500 hover:bg-blue-100' }}"
                            {{ $layanan->onFirstPage() ? 'disabled' : '' }}
                            onclick="window.location.href='{{ $layanan->previousPageUrl() }}'" aria-label="Previous">
                            &laquo;
                        </button>
                    </li>
                    @foreach ($layanan->getUrlRange(1, $layanan->lastPage()) as $page => $url)
                        <li>
                            <button
                                class="px-3 py-1 rounded border {{ $page == $layanan->currentPage() ? 'bg-blue-500 text-white' : 'bg-white text-gray-700 hover:bg-blue-100' }}"
                                onclick="window.location.href='{{ $url }}'">
                                {{ $page }}
                            </button>
                        </li>
                    @endforeach
                    <li>
                        <button
                            class="px-3 py-1 rounded border {{ $layanan->hasMorePages() ? 'bg-white text-blue-500 hover:bg-blue-100' : 'bg-gray-300 text-gray-500 cursor-not-allowed' }}"
                            {{ $layanan->hasMorePages() ? '' : 'disabled' }}
                            onclick="window.location.href='{{ $layanan->nextPageUrl() }}'" aria-label="Next">
                            &raquo;
                        </button>
                    </li>
                </ul>
            </nav>

        </main>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const successNotification = document.getElementById('successNotification');
        if (successNotification) {
            setTimeout(() => {
                successNotification.style.transition = 'opacity 0.5s';
                successNotification.style.opacity = '0';
                setTimeout(() => successNotification.remove(), 500);
            }, 5000);
        }
    });
</script>

</html>