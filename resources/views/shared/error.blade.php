@if ($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
        <p class="mb-0">
            @if ($errors->count() > 1)
                <strong>The following errors have occurred:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @else
                <strong>Error:</strong> {{ $errors->first() }}
            @endif
        </p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <p class="mb-0"><strong>Error:</strong> {{ session('error') }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
