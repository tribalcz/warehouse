@extends('base')

@section('content')
    <div class="container">
        <h2>Upravit sklad</h2>
        <form action="{{ route('warehouses.update', $warehouse->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="suppliers">Dodavatel:</label>
                <select class="form-control" id="suppliers" name="suppliers[]" multiple required>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
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
