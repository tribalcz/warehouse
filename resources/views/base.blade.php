<!DOCTYPE html>
<html lang="cs-CZ">
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="@yield('description')" />
    <title>@yield('title', env('APP_NAME'))</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>
<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">{{ env('APP_NAME') }}</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        @if(Route::has('dashboard'))
            <a class="p-2 text-dark" href="{{ route('dashboard') }}">Hlavní stránka</a>
        @endif
        @if(Route::has('products.index'))
            <a class="p-2 text-dark" href="{{ route('products.index') }}">Přehled produktů</a>
        @endif
        @if(Route::has('suppliers.index'))
            <a class="p-2 text-dark" href="{{ route('suppliers.index') }}">Přehled dodavatelů</a>
        @endif
        @if(Route::has('warehouses.index'))
            <a class="p-2 text-dark" href="{{ route('warehouses.index') }}">Přehled skladů</a>
        @endif
        @if(Route::has('manufacturers.index'))
            <a class="p-2 text-dark" href="{{ route('manufacturers.index') }}">Přehled výrobců</a>
        @endif
        @if(Route::has('categories.index'))
            <a class="p-2 text-dark" href="{{ route('categories.index') }}">Přehled kategorií</a>
        @endif
    </nav>
</div>

<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger mb-4">
            {{ Session::get('error')}}
        </div>
    @endif

        @if(Session::has('success'))
            <div class="alert alert-success mb-4">
                {{ Session::get('success')}}
            </div>
        @endif

    @yield('content')

    <footer class="pt-4 my-md-5 border-top">
        <p>
        </p>
    </footer>
</div>

@stack('scripts')
</body>
</html>
