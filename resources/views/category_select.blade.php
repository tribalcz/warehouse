{{--TODO: přesunout mezi dílčí pohledy... asi, dále využívat jako @include soubor... asi --}}
<select name="category_id" class="form-control">
    <option value="">-- Vyberte kategorii --</option>
    @include('partials.category_select.categories', ['partials.category_select.categories' => $categories, 'indent'=>0])
</select>
