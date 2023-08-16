@extends('base')

@section('content')
    <div class="container">
        <h2>Seznam kategorií</h2>
        @if(Route::has('categories.create'))
            <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i> Přidat kategorii
            </a>
        @endif
        <ul class="list-group">
            @foreach ($categories as $category)
                @include('partials.category_manager.category_item', ['category' => $category])
            @endforeach
        </ul>
    </div>
@endsection
