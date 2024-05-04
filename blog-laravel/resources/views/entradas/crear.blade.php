@extends('base')

@section('contenido')
<div class="container cuerpo text-center bg-info text-white py-3">
    <div>
        <h2>Nueva entrada</h2>
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
    <form action="{{ route('nuevaEntrada') }}" method="post" enctype="multipart/form-data">
        @csrf    
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" name="titulo">
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" name="imagen" class="form-control-file">
        </div>

        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <select name="categoria" class="form-control" name="categoria">
                @foreach ($categorias as $key)
                    <option value="{{ $key->id }}">{{ $key->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="ckeditor form-control" name="descripcion" required></textarea>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Registrar entrada</button>
    </form>
</div>

@endsection