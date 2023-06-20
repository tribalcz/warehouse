@extends('base')

@section('content')
    <div class="container">
        <h2>Úvodní stránka</h2>
        <div class="{{--row--}}">
            <div class="col-md-12">
                <h3>Produkty</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Název</th>
                        <th>Cena</th>
                        <th>Skladovost</th>
                        <th>Dodavatel</th>
                        <th>Sklad</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->qty }}</td>
                            <td>{{ $product->supplier->name ?? 'none' }}</td>
                            <td>{{ $product->warehouse->address ?? 'none' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <h3>Sklady</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Adresa</th>
                        <th>Dodavatel</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($warehouses as $warehouse)
                        <tr>
                            <td>{{ $warehouse->id }}</td>
                            <td>{{ $warehouse->address }}</td>
                            <td>{{ $warehouse->supplier->name ?? 'none'}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <h3>Dodavatelé</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Jméno</th>
                        <th>Adresa</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($suppliers as $supplier)
                        <tr>
                            <td>{{ $supplier->id }}</td>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->address }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

