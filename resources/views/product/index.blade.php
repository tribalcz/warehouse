@extends('base')

@section('content')
    <div class="container">
        <h2>Seznam produktů</h2>
        @if(Route::has('products.create'))
            <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i> Přidat produkt
            </a>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Název</th>
                <th>Cena</th>
                <th>Skladovost</th>
                <th>Sklad</th>
                <th>Dodavatel</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->qty ?? 0}}</td>
                    <td>
                        @foreach($product->getAvailableWarehouses() as $warehouse)
                            {{ $warehouse->address }} <br />
                        @endforeach
                    </td>
                    <td>
                        {{ $product->supplier->name }}
                    </td>
                    <td>
                        @if(Route::has('products.variant') && !$product->isVariant)
                            <a href="{{ route('products.variant', $product->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-clone"></i>
                            </a>
                        @endif
                        @if(Route::has('products.edit'))
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                        @endif
                        @if(Route::has('products.destroy'))
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Opravdu chcete smazat tento produkt?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
@endsection
