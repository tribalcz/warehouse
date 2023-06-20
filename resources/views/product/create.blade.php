@extends('base')

@section('content')
    <div class="container">
        <h2>Vytvořit produkt</h2>
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Název:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="price">Cena:</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="qty">Množství:</label>
                <input type="number" class="form-control" id="qty" name="qty" required>
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
                <label for="warehouse_id">Sklad:</label>
                <select class="form-control" id="warehouse_id" name="warehouse_id" required>
                    @foreach ($warehouses as $warehouse)
                        <option value="{{ $warehouse->id }}">{{ $warehouse->address }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Vytvořit</button>
        </form>
    </div>
@endsection
