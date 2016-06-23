

@extends('app')

@section('content')
    <div class="container">

        <h2>Pedido: #{{$order->id}} - R$ {{$order->total}}</h2>
        <h3>Cliente: {{$order->client->user->name}}</h3>
        <h4>Data: {{$order->created_at}}</h4>

        <p>
            <b>Entregar em:</b> <br>
            {{$order->client->address}} - {{$order->client->city}} - {{$order->client->state}}
        </p><br>

        {!! Form::model($order, ['route'=> ['admin.orders.update', $order->id]]) !!}


            <!--- Status Field --->
            <div class="form-group">
                {!! Form::label('status', 'Status:') !!}
                {!! Form::select('status', $list_status, null, ['class' => 'form-control']) !!}
            </div>
        
            <!--- Entregador Field --->
            <div class="form-group">
                {!! Form::label('user_deliveryman_id', 'Entregador:') !!}
                {!! Form::select('user_deliveryman_id', $deliveryMans, null, ['class' => 'form-control']) !!}
            </div>

            <!--- Submit Field --->
            <div class="form-group">
                {!! Form::submit('Salvar Pedido', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}


    </div>
@endsection