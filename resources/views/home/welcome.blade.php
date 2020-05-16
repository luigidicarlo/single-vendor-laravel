@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        @foreach ($products as $product)
        <div class="col-xs-12 col-sm-6 col-md-4">
            @include('products.product-card', ['product' => $product])
        </div>
        @endforeach
    </div>
    <div class="d-flex align-items-center justify-content-center">
        {{ $products->links() }}
    </div>
</div>

@endsection