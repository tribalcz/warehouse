@extends('base')

@section('content')
    <div class="container">
        <h2>Vytvořit sklad</h2>
        <form action="{{ route('warehouses.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="suppliers">Dodavatelé:</label>
                <select class="form-control" id="suppliers" name="suppliers[]" multiple required>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="address">Adresa:</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <button type="submit" class="btn btn-primary">Vytvořit</button>
        </form>
    </div>
@endsection
