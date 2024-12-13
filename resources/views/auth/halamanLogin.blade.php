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
        <!-- Bagian Kiri (Gambar dan Deskripsi) -->
        <div class="w-1/2 h-full relative">
            <img src="/images/image1.png" alt="Gambar" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black opacity-25"></div>
            <div class="absolute inset-0 flex flex-col items-center justify-center text-white text-center p-8">
                <h1 class="text-4xl font-bold mb-4">Welcome Back to Aundry!</h1>
                <p class="max-w-md text-lg">
                    Log in to manage your laundry services easily and efficiently.
                </p>
            </div>
        </div>

        <!-- Bagian Kanan (Form Login) -->
        <div class="w-1/2 flex items-center justify-center h-full">
            <div class="w-full max-w-sm p-8 bg-white rounded-xl shadow-lg bg-opacity-80">
                <h1 class="text-3xl font-bold text-gray-700 mb-6 text-center">Login</h1>

                @if(session('error'))
                    <div class="mb-4 p-3 text-red-700 bg-red-100 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label for="username" class="block text-sm font-medium text-gray-600">Username</label>
                        <input type="text" name="username" id="username" required
                            class="w-full px-4 py-3 mt-1 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-3 mt-1 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <button type="submit"
                        class="w-full px-4 py-3 text-white bg-blue-600 hover:bg-blue-700 rounded-xl font-semibold transition duration-200">
                        Login
                    </button>
                </form>

                <p class="mt-4 text-sm text-gray-600 text-center">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register here</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
