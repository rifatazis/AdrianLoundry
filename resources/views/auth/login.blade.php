<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="overflow-hidden">
    <div class="h-screen flex items-center justify-center bg-gray-100">
        <!-- Bagian Kiri (Gambar) -->
        <div class="w-1/2 bg-cover bg-center h-full">
            <img src="/images/ungu.jpeg" alt="Gambar" class="w-full h-full object-cover">
        </div>

        <!-- Bagian Kanan (Form Login) -->
        <div class="w-1/2 flex items-center justify-center h-full">
            <div class="w-full max-w-sm p-8 bg-white rounded-lg shadow-md">
                <h1 class="text-3xl font-bold text-gray-700 mb-6 text-center">Login</h1>

                @if(session('error'))
                    <div class="mb-4 p-3 text-red-700 bg-red-100 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-6">
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
                    <button type="submit"
                        class="w-full px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold">
                        Login
                    </button>
                </form>

                <p class="mt-4 text-sm text-gray-600 text-center">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
