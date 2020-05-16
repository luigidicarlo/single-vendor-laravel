{!! Form::open(['url' => '/shopping_cart_products', 'class' => 'add-to-cart', 'method' => 'POST']) !!}

<input type="hidden" name="product_id" value="{{ $product->id }}">
<input type="submit" value="Agregar al carrito" class="btn btn-primary btn-raised">

{!! Form::close() !!}