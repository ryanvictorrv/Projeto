<!DOCTYPE html>
<html>
<head>
    <title>Cadastro</title>
</head>
<body>
    <h1>Cadastro</h1>



    <form method="POST" action="/register">
        @csrf
        <label>Nome:</label>
        <input type="text" name="name" value="{{ old('name') }}" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required><br>

        <label>Senha:</label>
        <input type="password" name="password" required><br>


        <button type="submit">Cadastrar</button>
    </form>

    <p>Já tem uma conta? <a href="/login">Entrar</a></p>
</body>
</html>