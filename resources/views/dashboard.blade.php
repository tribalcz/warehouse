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
                        <th>Počet obrázků</th>
                        <th>Varianta</th>
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
                            <td>
                                @foreach($product->warehouses as $warehouse)
                                    {{ $warehouse->address }} <br />
                                @endforeach
                            </td>
                            <td>
                                @if($product->getNumberOfImages())
                                {{ $product->getNumberOfImages() }}
                                @endif
                            </td>
                            <td>
                                @if($product->isVariant)
                                    <i class="fas fa-check"></i>
                                @endif
                            </td>
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
                            <td>
                                @foreach($warehouse->suppliers as $supplier)
                                    {{ $supplier->name }} <br />
                                @endforeach
                            </td>
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

