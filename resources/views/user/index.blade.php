<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body class="bg-light">
    <div class="container py-4">
        @include('parts.header')

        <div class="card shadow-sm mt-4">
            <div class="card-header">

                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="h5 mb-0">Lista de usuários</h2>

                    <a href="{{ route('admin.users.create') }}"
                        class="btn btn-primary">
                        Novo usuário
                    </a>
                </div>

            </div>

            <div class="card-body">

                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Perfil</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->profile?->type ?? 'Sem perfil' }}</td>
                                <td>
                                    <a href="{{ route('admin.users.show', $user->id) }}"
                                        class="btn btn-sm btn-primary">
                                        Visualizar
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    Nenhum usuário encontrado.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $users->links() }}
            </div>
        </div>
    </div>
</body>

</html>