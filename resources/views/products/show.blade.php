@extends('layouts.app')

@section('content')

<div class="card product text-left">
    <div class="card-body">
        <h1 class="mb-4">{{ $product->name }}</h1>
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                {{-- Imagen del producto --}}
            </div>
            <div class="col-xs-12 col-sm-6">
                <p class="text-lead">
                    <strong>Descripción</strong>
                </p>
                <p>
                    {{ $product->description }}
                </p>
                <p>
                    @include('shopping-carts.form', ['product' => $product])
                </p>
            </div>
        </div>
    </div>
    @if (Auth::check() && $product->user_id === Auth::user()->id)
        <div class="card-footer">
            <span>Acciones: </span>
            <a class="btn btn-primary" href="{{ url('/products/'.$product->id.'/edit') }}">
                <i class="material-icons">edit</i>
            </a>
            @include('products.delete', ['product' => $product])
        </div>
    @endif
</div>

@endsection