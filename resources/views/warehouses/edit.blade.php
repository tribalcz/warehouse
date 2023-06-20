@extends('base')

@section('content')
    <div class="container">
        <h2>Upravit sklad</h2>
        <form action="{{ route('warehouses.update', $warehouse->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="supplier_id">Dodavatel:</label>
                <select class="form-control" id="supplier_id" name="supplier_id" required>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ $warehouse->supplier_id == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="address">Adresa:</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $warehouse->address }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Uložit</button>
        </form>
    </div>
@endsection
