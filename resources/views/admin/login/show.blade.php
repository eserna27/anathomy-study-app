@extends('layouts.admin_layout')
@section('content')
  <div class="row justify-content-md-center">
    <div class="col-6">
      <br>
      {{ Form::open(array('url' => route('admin.log'), 'method' => 'post')) }}
        <h1><u>Iniciar sesión</u></h1>
        @if ($errors->isNotEmpty())
          <ul style="">
            <li>{{ $errors->first('email') }}</li>
            <li>{{ $errors->first('password') }}</li>
          </ul>
        @endif
        <div class="row">
          <div class="form-group col-12">
            {{ Form::label('email', 'Correo') }}
            {{ Form::text('email', Input::old('email'), array('class' => 'form-control')) }}
          </div>
        </div>
        <div class="row">
          <div class="form-group col-12">
            {{ Form::label('password', 'Contraseña') }}
            {{ Form::password('password', array('class' => 'form-control')) }}
          </div>
        </div>
        <p>{{ Form::submit('Entrar', array('class' => 'btn btn-primary')) }}</p>
      {{ Form::close() }}
    </div>
  </div>
@endsection
