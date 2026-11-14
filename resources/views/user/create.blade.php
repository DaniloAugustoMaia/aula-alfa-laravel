
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Sistema Administrativo</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light">
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="text-center mb-4">Criar conta</h2>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" id="name" name="name"
                                    class="form-control" value="{{ old('name') }}"
                                    required maxlength="255">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" id="email" name="email"
                                    class="form-control" value="{{ old('email') }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" id="password" name="password"
                                    class="form-control" required minlength="8">
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">
                                    Confirmar senha
                                </label>
                                <input type="password" id="password_confirmation"
                                    name="password_confirmation"
                                    class="form-control" required minlength="8">
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                Cadastrar
                            </button>
                        </form>

                        <p class="text-center mt-3 mb-0">
                            Já possui uma conta?
                            <a href="{{ route('login') }}">Entrar</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>