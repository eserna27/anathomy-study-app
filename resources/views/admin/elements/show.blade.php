@extends('layouts.admin_layout')
@section('content')
  <br>
  <p>
    <a href="{{ route('admin.systems.show', $system->id) }}">
      <i class="fas fa-arrow-left"></i> Regresar
    </a>
  </p>
  <div class="row">
    <div class="col-12">
      <h1>
        {{ $system->name }} - {{ $element->name }}
      </h1>
    </div>
  </div>
  <hr>
  <br>
  <div class="row">
    <div class="col-6">
      <h4><u>Regiones</u></h4>
      <br>
      @if ($element->regions->isNotEmpty())
        <div class="card" style="width: 18rem;">
          <ul class="list-group list-group-flush">
            @foreach ($element->regions as $region)
              <li class="list-group-item">
                <strong>{{ $region->name }}</strong>
              </li>
            @endforeach
          </ul>
        </div>
      @endif
    </div>
    <div class="col-4 offset-1">
      <?php $data=[
        'form_title' => "Agregar Región",
        'method' => 'post',
        'route' => route('admin.elements.regions.store',
          ['element_id' => $element->id])
      ]?>
      @include('admin.elements.form_add_region', $data)
    </div>
  </div>
@endsection
