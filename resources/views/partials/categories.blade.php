@foreach($categories as $category)
    <option value="{{ $category->id }}">{{ $category->name }}</option>
    @foreach($category->childernCategories as $childCategory)
        @include('partials.child_category', ['child_category' => $childCategory, 'indent' => 1])
    @endforeach
@endforeach
