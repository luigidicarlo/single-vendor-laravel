@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white text-center">
        <h1>Productos</h1>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <a href="{{ url('/products/'.$product->id) }}" class="btn btn-primary" title="Ver producto">
                                <i class="material-icons">visibility</i>
                            </a>
                            <a href="{{ url('/products/'.$product->id.'/edit') }}" class="btn btn-primary" title="Editar producto">
                                <i class="material-icons">edit</i>
                            </a>
                            @include('products.delete', ['product' => $product])
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="floating">
    <a href="{{ url('/products/create') }}"
        class="btn btn-primary bmd-btn-fab d-flex align-items-center justify-content-center" title="Agregar producto">
        <i class="material-icons">add</i>
    </a>
</div>

@endsection