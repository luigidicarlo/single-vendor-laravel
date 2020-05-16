@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-6 offset-md-3">
            @include('products.product-card', ['product' => $product])
        </div>
    </div>
</div>

@endsection