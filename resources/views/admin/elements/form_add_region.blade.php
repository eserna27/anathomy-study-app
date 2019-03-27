{{ Form::open(array('url' => $data['route'], 'method' => $data['method'])) }}
  <h4><u>{{$data['form_title']}}</u></h4>
  <br>
  <div class="row">
    <div class="form-group col-12 {{ $errors->has('region_id') ? 'has-error' : '' }}">
      {{ Form::select('region', $regions_options, Input::old('region'),  ['class' => 'form-control', 'placeholder'=>'Seleciona']) }}
      <span class="text-danger">{{ $errors->first('region_id') }}</span>
    </div>
  </div>
  <p>{{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}</p>
{{ Form::close() }}
