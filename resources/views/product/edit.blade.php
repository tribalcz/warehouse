@extends('base')

@section('content')
    <div class="container">
        <h2>Upravit produkt - {{$product->name}}</h2>
        <div class="data-success"></div>
        <div class="data-error"></div>
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Název:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?: $product->name }}" required>
            </div>
            <div class="form-group">
                <label for="url">Url:</label>
                <input type="text" class="form-control" id="url" name="url" required minlength="10" maxlength="100" value="{{ old('url') ?: $product->url }}" readonly>
            </div>
            <div class="form-group">
                <label for="content">Titulek prouktu:</label>
                <textarea name="description" id="description" rows="2" class="form-control" required minlength="25" maxlength="255">{{ old('description') ?: $product->description}}</textarea>
                <div id="character-counter">
                    <span id="typed-characters">0</span>
                    <span>/</span>
                    <span id="maximum-characters">250</span>
                </div>
            </div>
            <div class="form-group">
                <label for="price">Cena:</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ old('price') ?: $product->price }}" required>
            </div>

            <div class="form-group">
                <label for="weight">Váha(g):</label>
                <input type="number" class="form-control" id="weight" name="weight" required step="any" value="{{ old('weight') ?: $product->weight }}">
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="code">Kód produktu:</label>
                        <input type="number" class="form-control" id="code" name="code" required minlength="8" maxlength="13" value="{{ old('code') ?: $product->code }}" readonly>
                    </div>
                    <div class="col">
                        <label for="ean">EAN kód:</label>
                        <input type="number" class="form-control" id="ean" name="ean" minlength="8" maxlength="14" value="{{ old('ean') ?: $product->ean }}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="qty">Skladovost:</label>
                <input type="number" class="form-control" id="qty" name="qty" value="{{ old('qty') ?: $product->qty }}" required>
            </div>
            <div class="form-group">
                <label for="manufacturer_id">Výrobce:</label>
                <select class="form-control" id="manufacturer_id" name="manufacturer_id" required>
                    <option value="" selected>-- Vyberte výrobce --</option>
                    @foreach($manufacturers as $manufacturer)
                        <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="supplier_id">Dodavatel:</label>
                <select class="form-control" id="supplier_id" name="supplier_id" required>
                    <option value="" selected>-- Vyberte dodavatele --</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ $product->supplier_id == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="warehouses">Sklad:</label>
                <select class="form-control" id="warehouses" name="warehouses[]" multiple required>
                    @foreach ($warehouses as $warehouse)
                        <option value="{{ $warehouse->id }}" {{ $product->warehouse_id == $warehouse->id ? 'selected' : '' }}>
                            {{ $warehouse->address }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="category">Kategorie:</label>
                @include('category_select', ['categories' => $categories])
            </div>
            <div class="form-group">
                <label for="images">Obrázky produktu:</label>
                <input type="file" class="form-control" id="images" name="images[]" multiple>
            </div>
            <div class="form-group">
                <label for="images">Obrázky produktu:</label>
                <div id="image-preview">
                    @foreach($product->getImagesPaths() as $image)
                        <div>
                            <img src="{{ asset('storage/' . $image->path) }}" alt="Product Image {{ $image->id }}" style="width: 100px; height: 100px;">
                            <button type="button" class="btn btn-danger btn-sm remove-image" data-image="{{ $image->path }}">Odstranit</button><br />
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <label for="content">Popis produktu:</label>
                <textarea name="content" id="content" class="form-control" rows="8" minlength="255">{{ old('content') ?: $product->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Uložit</button>
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
    <script type="text/javascript">
        //Odstranění obrázku produktu
        document.addEventListener('DOMContentLoaded', function() {
            const imagePreviewElement = document.querySelector('#image-preview');

            imagePreviewElement.addEventListener('click', function (event) {
                if (event.target.classList.contains('remove-image')) {
                    const imageContainer = event.target.parentNode;
                    const imagePath = event.target.getAttribute('data-image');
                    const productId = '{{ $product->id }}';

                    removeImage(imageContainer, imagePath, productId);
                }
            });

            function removeImage(imageContainer, imagePath, productId) {

                axios.delete(`/api/products/${productId}/images/${imagePath.replace('product_images/', '')}`)
                    .then(function(response) {
                        const successMessage = response.data.message;
                        showSuccessMessage(successMessage);
                        imageContainer.remove();
                    })
                    .catch(function(error) {
                        const errorMessage = error.response.data.message;
                        console.log(errorMessage);
                        showErrorMessage(errorMessage);
                    });
            }

            function showSuccessMessage(message) {
                const successDiv = document.querySelector('.data-success');
                successDiv.innerHTML = '<div class="alert alert-success mb-4">' + message + '</div>';

                successDiv.firstChild.classList.add('sticky-message');

                setTimeout(function () {
                    successDiv.innerHTML = '';
                }, 5000);
            }

            function showErrorMessage(message) {
                const successDiv = document.querySelector('.data-error');
                successDiv.innerHTML = '<div class="alert alert-danger mb-4">' + message + '</div>';

                successDiv.firstChild.classList.add('sticky-message');

                setTimeout(function () {
                    successDiv.innerHTML = '';
                }, 5000);
            }
        })
    </script>
@endpush
