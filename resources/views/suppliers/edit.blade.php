@extends('base')

@section('content')
    <div class="container">
        <h2>Upravit dodavatele</h2>
        <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Jméno:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $supplier->name }}" required>
            </div>
            <div class="form-group">
                <label for="address">Adresa:</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $supplier->address }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Uložit</button>
        </form>
    </div>
@endsection
