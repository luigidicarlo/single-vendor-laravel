@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header text-center bg-primary text-white">
        <h1>¡Compra completada!</h1>
    </div>
    <div class="card-body">
        <h3>Tu pago fue procesado con éxito</h3>
        <h4 class="{{ $order->status }}">{{ $order->getStatus() }}</h4>
        <p>Corrobora los detalles de tu envío: </p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <strong>Correo electrónico: </strong>
            </div>
            <div class="col-md-6">
                {{ $order->email }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <strong>Total pagado: </strong>
            </div>
            <div class="col-md-6">
                {{ $order->total }}
            </div>
        </div>
        <h4>Productos en la compra</h4>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shoppingCart->products()->get() as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center my-4">
            <a class="btn btn-primary btn-raised" href="{{ url('/cart/'.$order->shoppingCart()->first()->customid) }}">Enlace permanente de tu compra</a>
        </div>
    </div>
</div>

@endsection