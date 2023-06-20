@extends('base')

@section('content')
    <div class="container">
        <h2>Upravit produkt</h2>
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Název:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?: $product->name }}" required>
            </div>
            <div class="form-group">
                <label for="price">Cena:</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ old('price') ?: $product->price }}" required>
            </div>
            <div class="form-group">
                <label for="qty">Skladovost:</label>
                <input type="number" class="form-control" id="qty" name="qty" value="{{ old('qty') ?: $product->qty }}" required>
            </div>
            <div class="form-group">
                <label for="supplier_id">Dodavatel:</label>
                <select class="form-control" id="supplier_id" name="supplier_id" required>
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
            <button type="submit" class="btn btn-primary">Uložit</button>
        </form>
    </div>
@endsection
