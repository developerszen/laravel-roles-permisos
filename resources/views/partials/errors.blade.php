@if (session('errors'))
    <div class="alert alert-danger small" role="alert">
        <p class="mb-0"><strong>Por favor, corrige los siguientes errores</strong></p>
        <ul class="mb-0">
            @foreach(session('errors')->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif