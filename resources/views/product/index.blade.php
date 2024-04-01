@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
    <div class="row" id="contenedor">
        @include('product.productos')
    @endsection
