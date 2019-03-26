<br>
{{ Form::open(array('url' => $data['route'], 'method' => $data['method'])) }}
  <h1><u>{{$data['form_title']}}</u></h1>
  <div class="row">
    <div class="form-group col-12 {{ $errors->has('name') ? 'has-error' : '' }}">
      {{ Form::label('name', 'Nombre de región') }}
      {{ Form::text('name', $data['region_name'], array('class' => 'form-control')) }}
      @if ($data['parent_id'] != null)
        {{ Form::hidden('region_id', $data['parent_id']) }}
      @endif
      <span class="text-danger">{{ $errors->first('name') }}</span>
    </div>
  </div>
  <p>{{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}</p>
{{ Form::close() }}
