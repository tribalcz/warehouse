@extends('base')

@section('content')
    <div class="container">
        <h2>Upravit kategorii</h2>
        <form action="{{ route('categories.update', $category) }}" method="post">
            @csrf
            @method('put')
            <label for="name">Název:</label>
            <input type="text" name="name" value="{{ $category->name }}" required>
            <label for="parent_category">Nadřazená kategorie:</label>
            <select name="parent_category">
                <option value="">-- Vyberte kategorii --</option>
                @include('partials.category_select.categories', ['partials.category_select.categories' => $categories, 'indent'=>0])
            </select>
            <button type="submit">Uložit</button>
        </form>
    </div>
@endsection
