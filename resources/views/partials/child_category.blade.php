<option value="{{ $child_category->id }}">{{ str_repeat('--', $indent) }}{{ $child_category->name }}</option>
@foreach($child_category->childernCategories as $childCategory)
    @include('partials.child_category', ['child_category' => $childCategory, 'indent' => $indent+1])
@endforeach
