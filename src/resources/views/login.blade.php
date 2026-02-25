<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    @if($errors->any())
        <div style="color:red;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf
        <label>Email:</label>
        <input type="email" name="email" required>
        <br><br>
        <label>Senha:</label>
        <input type="password" name="password" required>
        <br><br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>