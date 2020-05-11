@extends('layouts.app')

@section('content')
    
<div class="card">
    <div class="card-header text-center bg-primary text-white">
        <h1>¡Compra completada!</h1>
    </div>
    <div class="card-body">
        <h3>Tu pago fue procesado con éxito</h3>
        <h4 class="{{ $details->status }}">{{ $details->getStatus() }}</h4>
        <p>Corrobora los detalles de tu envío: </p>
    </div>
</div>

@endsection