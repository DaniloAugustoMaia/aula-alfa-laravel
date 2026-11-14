<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
</head>
<body>
    <h1>Painel Administrativo</h1>
    <p>Bem-vindo, {{ Auth::user()->name }}!</p>
    <p>Você possui permissão de administrador.</p>

    <a href="{{ route('home') }}">Voltar ao início</a>
</body>
</html>