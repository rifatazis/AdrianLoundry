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
        <!-- Bagian Kiri (Gambar dan Deskripsi) -->
        <div class="w-1/2 h-full relative">
            <img src="/images/ungu.jpeg" alt="Gambar" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black opacity-25"></div>
            <div class="absolute inset-0 flex flex-col items-center justify-center text-white text-center p-8">
                <h1 class="text-4xl font-bold mb-4">Aundry Laundry Services</h1>
                <p class="max-w-md">
                    Enjoy your day, while we handle the laundry! Fast and reliable service – your clothes, fresher than ever!
                </p>
            </div>
        </div>

        <!-- Bagian Kanan (Form Register) -->
        <div class="w-1/2 flex items-center justify-center h-full">
            <div class="w-full max-w-sm p-8 bg-white rounded-lg shadow-lg">
                <h1 class="text-4xl font-bold text-gray-700 mb-6 text-center">Sign Up</h1>

                @if (session('success'))
                    <div class="mb-4 p-3 text-green-700 bg-green-100 rounded">
                        {{ session('success') }}
                    </div>
                @endif

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
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-600">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <button type="submit"
                        class="w-full px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold">
                        Create
                    </button>
                </form>

                <p class="mt-4 text-sm text-gray-600 text-center">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-red-500 hover:underline">Login here</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
