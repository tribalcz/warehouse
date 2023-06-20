@extends('base')

@section('content')
    <div class="container">
        <h2>Seznam skladů</h2>
        <a href="{{ route('warehouses.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i> Přidat sklad
        </a>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Dodavatel</th>
                <th>Adresa</th>
                <th>Akce</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($warehouses as $warehouse)
                <tr>
                    <td>{{ $warehouse->id }}</td>
                    <td>{{ $warehouse->supplier->name ?? 'Tento sklad nemá dodavatele'}}</td>
                    <td>{{ $warehouse->address }}</td>
                    <td>
                        <a href="{{ route('warehouses.edit', $warehouse->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('warehouses.destroy', $warehouse->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Opravdu chcete smazat tento sklad?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $warehouses->links() }}
    </div>
@endsection
