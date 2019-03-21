@extends('layouts.admin_layout')
@section('content')
  <h1>
    Regiones
  </h1>
  <hr>
  <div class="row">
    <div class="col-5">
      @if ($regions->isNotEmpty())
        <div class="card">
          <ul class="list-group list-group-flush">
            @foreach ($regions as $region)
              <li class="list-group-item">
                <div class="row">
                  <div class="col-8">
                    <strong>{{ $region->name }}</strong>
                  </div>
                  <div class="col-4">
                    <div class="row">
                      <a class="nav-link col-4" href="{{ route('admin.regions.show', $region->id) }}">
                        <i class="fas fa-eye"></i>
                      </a>
                      <a class="nav-link col-4" href="{{ route('admin.regions.show', $region->id) }}">
                        <i class="fas fa-edit text-info"></i>
                      </a>
                      <a class="nav-link col-4" href="{{ route('admin.regions.show', $region->id) }}">
                        <i class="fas fa-trash text-danger"></i>
                      </a>
                    </div>
                  </div>
              </li>
            @endforeach
          </ul>
        </div>
      @else
        <p>No hay Regiones</p>
      @endif
    </div>
    <div class="col-6 offset-1">
      <br>
      {{ Form::open(array('url' => route('admin.regions.store'), 'method' => 'post')) }}
        <h1><u>Nueva Región</u></h1>
        <div class="row">
          <div class="form-group col-12 {{ $errors->has('name') ? 'has-error' : '' }}">
            {{ Form::label('name', 'Nombre de región') }}
            {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
            <span class="text-danger">{{ $errors->first('name') }}</span>
          </div>
        </div>
        <p>{{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}</p>
      {{ Form::close() }}
    </div>
  </div>
@endsection
