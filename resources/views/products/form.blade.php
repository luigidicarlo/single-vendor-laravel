{!! Form::open(['url' => $url, 'method' => $method, 'files' => true]) !!}

<div class="form-group">
    {{ Form::text('name', $product->name, ['class' => 'form-control', 'placeholder' => 'Nombre...']) }}
</div>
<div class="form-group">
    {{ Form::file('image', ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::textarea('description', $product->description, ['class' => 'form-control', 'placeholder' => 'Describe tu producto...']) }}
</div>
<div class="form-group">
    {{ Form::number('price', $product->price, ['class' => 'form-control', 'step' => '0.01', 'placeholder' => 'Precio del producto (USD)']) }}
</div>
<div class="form-group text-center">
    <button type="submit" class="btn btn-primary">
        Guardar
    </button>
    <a href="{{ url('/products') }}" class="btn btn-danger">
        Regresar a listado de productos
    </a>
</div>

{!! Form::close() !!}