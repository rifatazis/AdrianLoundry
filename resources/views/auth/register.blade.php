<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="overflow-hidden">
    <div class="h-screen flex items-center justify-center bg-gray-100">
        <!-- Bagian Kiri (Gambar) -->
        <div class="w-1/2 bg-cover bg-center h-full">
            <img src="/images/ungu.jpeg" alt="Gambar" class="w-full h-full object-cover">
        </div>

        <!-- Bagian Kanan (Form Register) -->
        <div class="w-1/2 flex items-center justify-center h-full">
            <div class="w-full max-w-sm p-8 bg-white rounded-lg shadow-md">
                <h1 class="text-3xl font-bold text-gray-700 mb-6 text-center">Register</h1>

                @if ($errors->any())
                    <div class="mb-4 p-3 text-red-700 bg-red-100 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-600">Username</label>
                        <input type="text" name="username" id="username" required
                            class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-600">Konfirmasi
                            Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <button type="submit"
                        class="w-full px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold">
                        Daftar
                    </button>
                </form>

                <p class="mt-4 text-sm text-gray-600 text-center">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login disini</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
