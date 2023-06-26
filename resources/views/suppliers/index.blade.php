@extends('base')

@section('content')
    <div class="container">
        <h2>Seznam dodavatelů</h2>
        @if(Route::has('suppliers.create'))
            <a href="{{ route('suppliers.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i> Přidat dodavatele
            </a>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Jméno</th>
                <th>Adresa</th>
                <th>Akce</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->id }}</td>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->address }}</td>
                    <td>
                        <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Opravdu chcete smazat tohoto dodavatele?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $suppliers->links() }}
    </div>
@endsection
