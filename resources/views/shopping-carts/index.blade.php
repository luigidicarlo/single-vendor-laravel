@extends('layouts.app')

@section('content')
    <div class="card bg-white">
        <div class="card-body">
            <div class="text-center">
                <h1>Carrito de compras</h1>
                <h5>Total a pagar: {{ $total }}</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    <a href="{{ url('/products/'.$product->id) }}" class="btn btn-sm btn-primary" title="Ver producto">
                                        <i class="material-icons">visibility</i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-danger" title="Eliminar producto del carrito">
                                        <i class="material-icons">remove</i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td><strong>Total a pagar</strong></td>
                            <td colspan="2" title="Cantidad total a pagar">{{ $total }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-right">
                <a href="{{ route('pay') }}" class="btn btn-primary btn-raised">
                    Pagar
                </a>
            </div>
        </div>
    </div>
@endsection