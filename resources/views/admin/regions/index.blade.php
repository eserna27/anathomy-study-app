@extends('layouts.admin_layout')
@section('content')
  <br>
  <p>
    <a href="{{ route('admin.home') }}">
      <i class="fas fa-arrow-left"></i> Regresar
    </a>
  </p>
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
                      <a class="nav-link col-4" href="{{ route('admin.regions.destroy', $region->id) }}">
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
      <?php $data=[
        'form_title' => "Nueva Región",
        'region_id' => null,
      ]?>
      @include('admin.regions.form', $data)
    </div>
  </div>
@endsection
