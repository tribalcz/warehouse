<li class="list-group-item">
    {{ $category->name }}
    <a href="{{ route('categories.edit', $category) }}">Upravit</a>
    <form action="{{ route('categories.destroy', $category) }}" method="post">
        @csrf
        @method('delete')
        <button type="submit">Smazat</button>
    </form>
    @if ($category->childernCategories)
    <ul>
        @foreach ($category->childernCategories as $childCategory)
        @include('partials.category_manager.category_item', ['category' => $childCategory, 'indent' => '---'])
        @endforeach
    </ul>
    @endif
</li>
