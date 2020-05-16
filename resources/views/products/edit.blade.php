@extends('layouts.app')

@section('content')
    
<div class="row">
    <div class="col-xs-12 col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                <h1>Editar Producto {{ $product->name }}</h1>
            </div>
            <div class="card-body">
                @include('products.form', [
                    'product' => $product,
                    'url' => '/products/'.$product->id,
                    'method' => 'PATCH'
                ])
            </div>
        </div>
    </div>
</div>

@endsection