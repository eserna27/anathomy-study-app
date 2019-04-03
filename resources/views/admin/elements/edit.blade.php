@extends('layouts.admin_layout')
@section('content')
  @include('return')
  <h1>
    {{ $system->name }} - <small>Editar {{ $element->name }}</small>
  </h1>
  <hr>
  <br>
  <div class="row">
    <div class="col-4">
      {{ Form::open(array('url' => route('admin.systems.elements.update',
        ['system_id' => $system->id, 'element_id' => $element->id]), 'method' => 'patch')) }}
        <div class="row">
          <div class="form-group col-12 {{ $errors->has('name') ? 'has-error' : '' }}">
            {{ Form::label('name', 'Nombre del elemento') }}
            {{ Form::text('name', $element->name, array('class' => 'form-control')) }}
            <span class="text-danger">{{ $errors->first('name') }}</span>
          </div>
          <div class="form-group col-12 {{ $errors->has('kind') ? 'has-error' : '' }}">
            {{ Form::label('kind', 'Selecciona tipo') }}
            {{ Form::select('kind', $kind_options, $element->kind,  ['class' => 'form-control', 'placeholder'=>'Seleciona']) }}
            <span class="text-danger">{{ $errors->first('kind') }}</span>
          </div>
        </div>
        <p>{{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}</p>
      {{ Form::close() }}
    </div>
  </div>
@endsection
