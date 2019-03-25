<br>
{{ Form::open(array('url' => route('admin.regions.store'), 'method' => 'post')) }}
  <h1><u>{{$data['form_title']}}</u></h1>
  <div class="row">
    <div class="form-group col-12 {{ $errors->has('name') ? 'has-error' : '' }}">
      {{ Form::label('name', 'Nombre de región') }}
      {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
      @if ($data['region_id'] != null)
        {{ Form::hidden('region_id', $data['region_id']) }}
      @endif
      <span class="text-danger">{{ $errors->first('name') }}</span>
    </div>
  </div>
  <p>{{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}</p>
{{ Form::close() }}
