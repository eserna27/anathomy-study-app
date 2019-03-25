
@extends('layout')
@section('content')
  <br>
  <p>
    <a href="{{ route('admin.regions.index') }}">
      <i class="fas fa-arrow-left"></i> Regresar
    </a>
  </p>
  <h1>
    {{ $region->name }}
  </h1>
  <hr>
  <div class="row">
    <div class="col-5">
      @if ($sub_regions->isNotEmpty())
        <div class="card">
          <ul class="list-group list-group-flush">
            @foreach ($sub_regions as $sub_region)
              <li class="list-group-item">
                <div class="row">
                  <div class="col-8">
                    <strong>{{ $sub_region->name }}</strong>
                  </div>
                  <div class="col-4">
                    <div class="row">
                      <a class="nav-link col-4" href="{{ route('admin.regions.show', $sub_region->id) }}">
                        <i class="fas fa-eye"></i>
                      </a>
                      <a class="nav-link col-4" href="{{ route('admin.regions.show', $sub_region->id) }}">
                        <i class="fas fa-edit text-info"></i>
                      </a>
                      <a class="nav-link col-4" href="{{ route('admin.regions.show', $sub_region->id) }}">
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
        'form_title' => "Nueva Subregión",
        'region_id' => $region->id,
      ]?>
      @include('admin.regions.form', $data)
    </div>
  </div>
@endsection
