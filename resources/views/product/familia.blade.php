@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
    <form method="POST" action="{{ route('product.buscarFamilia') }}">
        @csrf
        <div class="mb-3 row">
            <label for="familia" class="col-lg-2 col-md-6 col-sm-12 col-form-label">Selecciona una Familia:</label>
            <div class="col-lg-10 col-md-12 col-sm-14">
                <div class="input-group">
                    <select class="form-select" id="familia" name="familia">
                        @foreach ($viewData['familias'] as $familia)
                            <option value="{{ $familia->familia }}">{{ $familia->familia }}</option>
                        @endforeach
                    </select>
                    <button class="btn bg-primary text-white" type="submit">Buscar Familia</button>
                </div>
            </div>
        </div>
    </form>
    </div>
    </div>
    </form>
    <div class="row" id="contenedor">
        @include('product.productos')
    </div>
    <div id="cargando">
    </div>
@endsection
