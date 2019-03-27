{{ Form::open(array('url' => $data['route'], 'method' => $data['method'])) }}
  <h1><u>{{$data['form_title']}}</u></h1>
  <div class="row">
    <div class="form-group col-12 {{ $errors->has('name') ? 'has-error' : '' }}">
      {{ Form::label('name', 'Nombre del elemento') }}
      {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
      <span class="text-danger">{{ $errors->first('name') }}</span>
    </div>
    <div class="form-group col-12 {{ $errors->has('kind') ? 'has-error' : '' }}">
      {{ Form::label('kind', 'Selecciona tipo') }}
      {{ Form::select('kind', $kind_options, Input::old('kind'),  ['class' => 'form-control', 'placeholder'=>'Seleciona']) }}
      <span class="text-danger">{{ $errors->first('kind') }}</span>
    </div>
  </div>
  <p>{{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}</p>
{{ Form::close() }}
