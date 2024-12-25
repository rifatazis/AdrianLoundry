@extends('layouts.master')

@section('title', 'Adrian Laundry')

@section('content')
<div class="flex">
    <!-- Kiri: Teks -->
    <div class="w-1/2 ml-10 text-white p-8 flex items-center">
        <div class="ml-40">
            <h1 class="text-5xl font-bold">Welcome to Adrian Laundry</h1>
            <p class="mt-4 text-xl">Efficiently manage your laundry services with ease and convenience.</p>
        </div>
    </div>

    <!-- Kanan: Gambar -->
    <div class="w-1/2 bg-cover bg-center p-8 flex items-center justify-center">
        <img class="h-90 w-90" src="{{ asset('images/home.png') }}" alt="Laundry Image">
    </div>
</div>

<main class="flex items-center justify-center h-full pb-12">
    <div class="w-full max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-white">Layanan Tersedia</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($layanan as $item)
                <div>
                    <div class="flex justify-center">
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_layanan }}"
                            class="rounded-[45px] w-48 h-48 object-cover object-center shadow-sm">
                    </div>
                    <div class="text-center">
                        <h3 class="text-xl text-white font-bold mt-4 ">{{ $item->nama_layanan }}</h3>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>
@endsection
