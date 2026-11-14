<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema Administrativo</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light">
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="text-center mb-4">Entrar no sistema</h2>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" name="email" id="email"
                                    class="form-control" value="{{ old('email') }}"
                                    required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" name="password" id="password"
                                    class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                Entrar
                            </button>
                            <p class="text-center mt-3 mb-0">
                            Não possui uma conta?
                            <a href="{{ route('register') }}">Cadastre-se</a>
                            </p>
                            @if (session('success'))
                            <div class="alert alert-success">
                            {{ session('success') }}
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>