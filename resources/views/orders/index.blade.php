@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Dashboard</h2>
        </div>
        <div class="card-body">
            <h3>Estadísticas</h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th>Ingresos del mes</th>
                        <td>{{ $totalMonth }}USD</td>
                    </tr>
                    <tr>
                        <th>Número de ventas</th>
                        <td>{{ $totalMonthCount }}</td>
                    </tr>
                </table>
            </div>

            <h3>Ventas</h3>
            <div class="table-responsive">
                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Comprador</th>
                            <th>Estado</th>
                            <th>Ingresos</th>
                            <th>Fecha de venta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->email }}</td>
                            <td>
                                <a class="order-status-select" href="#" data-type="select" data-pk="{{ $order->id }}"
                                    data-url="{{ url('/orders/'.$order->id) }}" data-title="Estado"
                                    data-value="{{ $order->status }}" data-name="status"></a>
                            </td>
                            <td>{{ $order->total }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>
                                Acciones
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsectionStatus