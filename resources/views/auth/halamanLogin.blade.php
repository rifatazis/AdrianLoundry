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
        <!-- Bagian Kiri  -->
        <div class="w-1/2 h-full relative hidden lg:block">
            <img src="/images/image1.png" alt="Gambar" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black opacity-25"></div>
            <div class="absolute inset-0 flex flex-col items-center justify-center text-white text-center p-8 ">
                <h1 class="text-4xl font-bold mb-4">Welcome Back to Adrian Laundry!</h1>
                <p class="max-w-md text-lg">
                    Log in to manage your laundry services easily and efficiently.
                </p>
            </div>
        </div>

        <!-- Bagian Kanan  -->
        <div class="w-full lg:w-1/2 flex p-0 h-screen">
            <div class="w-full max-w-sm mx-auto flex flex-col justify-start pt-20">

                <h1 class="text-8xl font-bold text-gray-900 mb-4 text-center">Login</h1>
                <p class="text-center text-lg font-medium text-gray-700 mb-12">Welcome back friends!</p>

                @if(session('error'))
                    <div class="mb-4 p-3 text-red-700 bg-red-100 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif


                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <input type="text" name="username" id="username" placeholder="USERNAME" required
                            class="w-full mb-3 px-4 py-3 border border-gray-300 bg-[#DFE3EF] rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <input type="password" name="password" id="password" placeholder="PASSWORD" required
                            class="w-full mb-5 px-4 py-3 border border-gray-300 bg-[#DFE3EF] rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="flex justify-center">
                        <button type="submit"
                            class="w-40 px-6 py-3 text-white bg-[#7180B5] hover:bg-[#5D6A8A] rounded-full font-semibold transition duration-200">
                            Login
                        </button>
                    </div>
                </form>

                <p class="mt-4 text-sm text-center">
                    <span class="text-gray-600">Don't have an account?</span>
                    <a href="{{ route('register') }}" class="text-red-600 hover:underline">Create an account</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>