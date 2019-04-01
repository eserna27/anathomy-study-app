{{ Form::open(array('url' => route('admin.elements.definitions.store', $element->id), 'method' => 'post')) }}
  <div class="row">
    <div class="form-group col-12 {{ $errors->has('definition') ? 'has-error' : '' }}">
      {{ Form::label('definition', 'Escriba la definición') }}
      {{ Form::textarea('definition', Input::old('definition'), array('class' => 'form-control')) }}
      <span class="text-danger">{{ $errors->first('definition') }}</span>
    </div>
  </div>
  <p>{{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}</p>
{{ Form::close() }}
