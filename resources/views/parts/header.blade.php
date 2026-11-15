<header class="d-flex justify-content-between align-items-center border-bottom pb-3">
    <div>
        <h5 class="mb-0" style="color: #212529;">
            Área administrativa
        </h5>

        <small style="color: #495057;">
            {{ Auth::user()->name }}
        </small>
    </div>

    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
            Início
        </a>

        <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf

            <button type="submit" class="btn btn-danger">
                Sair
            </button>
        </form>
    </div>
</header>