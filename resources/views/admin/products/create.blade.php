

@extends('app')

@section('content')
    <div class="container">


        <h3>Criar Produto</h3>

        @include('errors._check')


        {!! Form::open(['route'=>'admin.products.store']) !!}

            @include('admin.products._form')

            <!--- Submit Field --->
            <div class="form-group">
                {!! Form::submit('Criar Produto', ['class' => 'btn btn-primary']) !!}
            </div>


        {!! Form::close() !!}

    </div>
@endsection