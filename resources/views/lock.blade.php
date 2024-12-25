<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lockscreen</title>
</head>
<body>
    <h1>Sistem Terkunci</h1>
    <p>Sistem telah terkunci karena tidak ada aktivitas dalam waktu tertentu.</p>

    <form action="{{ route('unlock') }}" method="POST">
        @csrf
        <label for="password">Masukkan Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Buka Kunci</button>
    </form>

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
</body>
</html>
