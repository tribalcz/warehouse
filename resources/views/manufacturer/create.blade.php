@extends('base')

@section('content')
    <div class="container">
        <h2>Vytvořit výrobce</h2>
        <form action="{{ route('manufacturers.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Název</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Popis výrobce:</label>
                <textarea name="description" id="description" class="form-control" rows="8" minlength="255">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Vytvořit</button>
        </form>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('//cdn.tiny.cloud/1/4ca77c2b4xkblb863muluki6gqr14sx1p7lbrqasfyqroko6/tinymce/6/tinymce.min.js') }}"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#description',
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste'
            ],
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            entities: '160,nbsp',
            entity_encoding: 'raw',
        });
    </script>
@endpush
