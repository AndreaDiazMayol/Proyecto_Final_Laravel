@php
    $productId = $viewData['product']->getId();
@endphp
{{-- has verifica si una clave específica existe en la sesión. --}}
@if (session()->has("comentarios.$productId"))
    <form action="{{ route('product.borrarComentarios', ['id' => $productId]) }}" method="POST"
        onSubmit="return confirm('Estás seguro?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">
            <i class="bi-trash">Borrar</i>
        </button>
    </form>
@endif
