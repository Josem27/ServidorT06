@extends('base')
@section('contenido')
@foreach ($detalles as $entrada)

<div class="container cuerpo text-center bg-info text-white py-3">
    <div>
        <h2>Editando entrada</h2>
    </div>
    <hr class="bg-light" width="50%">
</div>

<div class="container cuerpo text-center bg-info text-white py-3">
    <div>
        <a class="btn btn-primary" href="{{ route('entradas',[0]) }}" role="button">Volver</a>
    </div>
    <hr class="bg-light" width="50%">
</div>

<div class="container text-center">
    <form action="{{ route('editar',$entrada->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" name="titulo" value="{{ $entrada->titulo }}">
        </div>

        <div class="mb-3">
            <img src="{{ asset('storage/fotos/'.$entrada->imagen) }}" width="260"><br>
            <label for="imagen" class="form-label">Imagen <input type="file" name="imagen" class="form-control-file"></label>
        </div>

        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <select name="categoria" class="form-control" name="categoria">
                @foreach ($categorias as $key)
                <option value="{{ $key->id }}" {{ $key->id == $entrada->categoria_id ? 'selected' : '' }}>{{ $key->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="ckeditor form-control" name="descripcion" required>{{ $entrada->descripcion }}</textarea>
        </div>

        <input type="hidden" name="usuario_id" value="{{ $entrada->usuario_id }}">

        <button type="submit" name="submit" class="btn btn-primary">Editar entrada</button>
    </form>
</div>

@endforeach
@endsection