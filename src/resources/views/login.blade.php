<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    @if (session('info'))
        <div style="color:blue">{{ session('info') }}</div>
    @endif
    @if (session('success'))
        <div style="color:green">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div style="color:red;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf
        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email', session('email')) }}" required>
        <br><br>
        <label>Senha:</label>
        <input type="password" name="password" required>
        <br><br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>