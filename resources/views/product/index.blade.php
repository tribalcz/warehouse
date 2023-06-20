@extends('base')

@section('content')
    <div class="container">
        <h2>Seznam produktů</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i> Přidat produkt
        </a>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Název</th>
                <th>Cena</th>
                <th>Skladovost</th>
                <th>Sklad</th>
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
                            {{ $warehouse->address }}
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Opravdu chcete smazat tento produkt?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
@endsection
