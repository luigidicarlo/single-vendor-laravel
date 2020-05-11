{!! Form::open(['url' => url('/products/'.$product->id), 'method' => 'DELETE', 'class' => 'd-inline-block']) !!}
    <button type="submit" class="btn btn-danger" title="Eliminar producto">
        <i class="material-icons">delete</i>
    </button>
{!! Form::close() !!}