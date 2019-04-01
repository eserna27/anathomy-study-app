@extends('layouts.admin_layout')
@section('content')
  <br>
  <p>
    <a href="{{ route('admin.systems.index') }}">
      <i class="fas fa-arrow-left"></i> Regresar
    </a>
  </p>
  <h1>
    {{ $system->name }} - <small>Region {{ $region->name}}</small>
  </h1>
  <hr>
  <br>
  <div class="row">
    <div class="col-4">
      <h4>Subregiones</h4>
      <hr>
      @if ($region->children->isNotEmpty())
        <div class="card" style="width: 18rem;">
          <ul class="list-group list-group-flush">
            @foreach ($region->children as $region_child)
              <li class="list-group-item">
                <a class="nav-link" href="{{ route('admin.systems.regions.show',
                  ['system_id' => $system->id,
                   'region_id' => $region_child->id]) }}">
                  <strong>{{ $region_child->name }}</strong> <span class="sr-only">(current)</span>
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      @else
        No hay Regiones
      @endif
    </div>
    <div class="col-4">
      <h4>Elementos</h4>
      <hr>
      @if ($region->elements->isNotEmpty())
        <div class="card" style="width: 18rem;">
          <ul class="list-group list-group-flush">
            @foreach ($region->elements as $element)
              <li class="list-group-item">
                <a class="nav-link" href="{{ route('admin.systems.regions.elements.show',
                  ['system_id' => $system->id,
                   'region_id' => $region->id,
                   'element_id' => $element->id]) }}">
                  <strong>{{ $element->name }}</strong> <span class="sr-only">(current)</span>
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      @else
        No hay elementos
      @endif
    </div>
    <div class="col-4">
      <?php $data=[
        'form_title' => "Nuevo Elemento",
        'system_name' => null,
        'method' => 'post',
        'route' => route('admin.systems.regions.elements.store',
          ['system_id' => $system->id,
           'region_id' => $region->id])
      ]?>
      @include('admin.elements.form', $data)
    </div>
  </div>
@endsection
