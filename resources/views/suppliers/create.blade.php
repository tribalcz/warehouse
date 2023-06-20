@extends('base')

@section('content')
    <div class="container">
        <h2>Vytvořit dodavatele</h2>
        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Jméno:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="address">Adresa:</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <button type="submit" class="btn btn-primary">Vytvořit</button>
        </form>
    </div>
@endsection
