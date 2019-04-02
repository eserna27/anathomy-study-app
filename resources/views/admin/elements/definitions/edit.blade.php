@extends('layouts.admin_layout')
@section('content')
  <br>
  <p>
    <a href="{{ route('admin.systems.elements.show', ['system_id' => $element->system_id, 'element_id' => $element->id]) }}">
      <i class="fas fa-arrow-left"></i> Regresar
    </a>
  </p>
  <div class="row">
    <div class="col-12">
      <h1>
        <small>Actualizar definición </small><strong>{{ $element->name }}</strong>
      </h1>
    </div>
  </div>
  <hr>
  <br>
  <div class="row">
    <div class="col-8">
      {{ Form::open(array('url' => route('admin.elements.definitions.update',
        ['element_id' => $element->id, 'definition_id' => $definition->id]), 'method' => 'patch')) }}
        <div class="row">
          <div class="form-group col-12 {{ $errors->has('definition') ? 'has-error' : '' }}">
            {{ Form::label('definition', 'Escriba la definición') }}
            {{ Form::textarea('definition', $definition->definition, array('class' => 'form-control')) }}
            <span class="text-danger">{{ $errors->first('definition') }}</span>
          </div>
        </div>
        <p>{{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}</p>
      {{ Form::close() }}
    </div>
@endsection
