@extends('base')

@section('content')
    <div class="container">
        <h2>Vytvořit produkt</h2>
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Název:</label>
                <input type="text" class="form-control" id="name" name="name" required minlength="10" maxlength="80" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="url">Url:</label>
                <input type="text" class="form-control" id="url" name="url" required minlength="10" maxlength="100" value="{{ old('url') }}">
            </div>
            <div class="form-group">
                <label for="content">Titulek produktu:</label>
                <textarea name="description" id="description" rows="2" class="form-control" required minlength="25" maxlength="255">{{ old('description') }}</textarea>
                <div id="character-counter">
                    <span id="typed-characters">0</span>
                    <span>/</span>
                    <span id="maximum-characters">250</span>
                </div>
            </div>
            <div class="form-group">
                <label for="price">Cena:</label>
                <input type="number" class="form-control" id="price" name="price" required value="{{ old('price') }}">
            </div>
            <div class="form-group">
                <label for="weight">Váha(g):</label>
                <input type="number" class="form-control" id="weight" name="weight" required step="any" value="{{ old('weight') }}">
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="code">Kód produktu:</label>
                        <input type="number" class="form-control" id="code" name="code" required minlength="8" maxlength="13" value="{{ old('code') }}">
                    </div>
                    <div class="col">
                        <label for="ean">EAN kód:</label>
                        <input type="number" class="form-control" id="ean" name="ean" minlength="8" maxlength="14" value="{{ old('ean') }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="qty">Množství:</label>
                <input type="number" class="form-control" id="qty" name="qty" required value="{{ old('qty') }}">
            </div>
            <div class="form-group">
                <label for="supplier_id">Dodavatel:</label>
                <select class="form-control" id="supplier_id" name="supplier_id" required>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="warehouses">Sklad:</label>
                <select class="form-control" id="warehouses" name="warehouses[]" multiple required>
                    @foreach ($warehouses as $warehouse)
                        <option value="{{ $warehouse->id }}">{{ $warehouse->address }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="content">Popis produktu</label>
                <textarea name="content" id="content" class="form-control" rows="8" minlength="255">{{ old('content') ?: $product->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Vytvořit</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('//cdn.tiny.cloud/1/4ca77c2b4xkblb863muluki6gqr14sx1p7lbrqasfyqroko6/tinymce/6/tinymce.min.js') }}"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#content',
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste'
            ],
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            entities: '160,nbsp',
            entity_encoding: 'raw',
        });
    </script>
    <script type="text/javascript">
        //Funkce pro automatické vytcáření url produktu
        function getPrettyURL(text) {
            var normalizedText = text.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
            var lowercaseText = normalizedText.toLowerCase();
            var prettyURL = lowercaseText.replace(/\s+/g, "-");

            return prettyURL;
        }

        function handleBlur() {
            var nameInput = document.getElementById("name");
            var urlInput = document.getElementById("url");

            var nameValue = nameInput.value;
            var prettyURL = getPrettyURL(nameValue);

            urlInput.value = prettyURL;
        }

        var nameInput = document.getElementById("name");
        nameInput.addEventListener("blur", handleBlur);
    </script>
    <script type="text/javascript">
        //Počítadlo znaků pro popisek produktu
        const textAreaElement = document.querySelector("#description");
        const characterCounterElement = document.querySelector("#character-counter");
        const typedCharactersElement = document.querySelector("#typed-characters");
        const maximumCharacters = 250;

        textAreaElement.addEventListener("keydown", (event) => {
            const typedCharacters = textAreaElement.value.length;

            if (typedCharacters > maximumCharacters) {
                return false;
            }

            typedCharactersElement.textContent = typedCharacters;

            if (typedCharacters >= 200 && typedCharacters < 250) {
                characterCounterElement.classList = "text-warning";
            } else if (typedCharacters >= 250) {
                characterCounterElement.classList = "text-danger";
            }else if (typedCharacters < 250) {
                characterCounterElement.classList = "text-dark";
            }
        });
    </script>
@endpush
