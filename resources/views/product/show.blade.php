@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('/storage/' . $viewData['product']->getImage()) }}" class="img-fluid rounded-start">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">
                        {{ $viewData['product']->getName() }} (${{ $viewData['product']->getPrice() }})
                    </h5>
                    <p class="card-text">{{ $viewData['product']->getDescription() }}</p>
                    <p class="card-text"><small class="text-muted">Add to Cart</small></p>
                    <a href="{{ route('product.index') }}" class="btn bg-primary text-white">Volver</a>
                </div>
            </div>
        </div>
    </div>
    {{-- Para añadir Comentarios --}}
    <div class="card mt-3">
        <div class="card-body">
            <h4 class="text-center">Comentarios:</h4>
            <form method="post" action="{{ route('product.comentarios', ['id' => $viewData['product']->getId()]) }}">
                @csrf
                <div class="mb-3">
                    <label for="comentario" class="form-label">
                        <h5>Escribe un comentario:</h5>
                    </label>
                    <textarea class="form-control" name="comentario" id="comentario" rows="3"></textarea>
                </div>
                <button type="submit" class="btn bg-primary text-white">Enviar</button>
            </form>
        </div>
    </div>
    @if (session('alert'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('alert') }}
            <button type="button" class="btn-close fade" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- Para mostrar los comentarios --}}
    <div class="col-md-8">
        <div class="card-body">
            @if ($viewData['comentarios']->count() > 0)
                <div class="col-md-8">
                    <div class="card-body">
                        @foreach ($viewData['comentarios'] as $indice => $comentario)
                            <div class="mb-3 d-flex justify-content-between">
                                <div>
                                    <p>
                                        <strong>{{ $comentario->usuario->name }}</strong> dijo:
                                        {{ $comentario->comentario }}
                                    </p>
                                    <small class="text-muted">{{ $comentario->created_at->diffForHumans() }}</small>
                                </div>

                                {{-- Mostrar el botón de borrar solo si eres el creador del comentario --}}
                                {{-- Si esta autentificado y si el id del autentificado es igual al id del usuario del comentario --}}
                                @if (auth()->check() && auth()->id() === $comentario->usuario->id)
                                    <form
                                        action="{{ route('product.borrarComentario', ['id' => $viewData['product']->getId(), 'idComentario' => $comentario->id]) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="col-md-8">
                    <div class="card-body">
                        <p>No hay comentarios disponibles</p>
                    </div>
                </div>
            @endif
        </div>
    </div>


@endsection
