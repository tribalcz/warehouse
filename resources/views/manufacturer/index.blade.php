@extends('base')

@section('content')
    <div class="container">
        <h2>Seznam výrobců</h2>
        <a href="{{ route('manufacturers.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i> Přidat výrobce
        </a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Název</th>
                    <th>Popis</th>
                    <th>Akce</th>
                </tr>
            </thead>
            <tbody>
                @foreach($manufacturers as $manufacturer)
                    <tr>
                        <td>{{ $manufacturer->id }}</td>
                        <td>{{ $manufacturer->name }}</td>
                        <td>{{ $manufacturer->description }}</td>
                        <td>
                            <a href="{{ route('manufacturers.edit', $manufacturer->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('manufacturers.destroy', $manufacturer->id) }}" method="POST" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
