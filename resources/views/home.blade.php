<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Autenticada</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light">
    <main class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1>Bem-vindo, {{ Auth::user()->name }}!</h1>

                <p>Você está autenticado no sistema.</p>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        Sair
                    </button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>