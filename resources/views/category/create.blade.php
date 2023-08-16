@extends('base')

@section('content')
    <div class="container">
        <h2>Vytvořit kategorii</h2>
        <form action="{{ route('categories.store') }}" method="post">
            @csrf
            <label for="name">Název:</label>
            <input type="text" name="name" required>
            <label for="parent_category">Nadřazená kategorie:</label>
            <select name="parent_category">
                <option value="">-- Vyberte kategorii --</option>
                @include('partials.category_select.categories', ['partials.category_select.categories' => $categories, 'indent'=>0])
            </select>
            <button type="submit">Vytvořit</button>
        </form>
    </div>
@endsection
