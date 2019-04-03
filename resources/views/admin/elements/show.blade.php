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
    <div class="col-4 offset-7">
      <a class="btn btn-primary float-right" href="{{ route('admin.elements.definitions.index', $element->id) }}">
        <i class="fas fa-glasses"></i>
        Ver Definiciones
      </a>
      <a class="btn btn-primary float-right" href="{{ route('admin.systems.elements.create',
        ['system_id' => $system->id, 'element_id' => $element->id]) }}" style="margin-right: 15px;">
        <i class="fas fa-plus"></i>
        Nuevo Elemento
      </a>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-6">
      <h4><u>Secciones</u></h4>
      <br>
      @if ($element->parts()->isNotEmpty())
        <div class="card">
          <ul class="list-group list-group-flush">
            @foreach ($element->parts() as $part)
              <li class="list-group-item">
                <div class="row">
                  <div class="col-10">
                    <a class="nav-link" href="{{ route('admin.systems.elements.show',
                      ['system_id' => $system->id,
                       'element_id' => $part->id]) }}">
                      <strong>{{ $part->name }}</strong> <span class="sr-only">(current)</span>
                    </a>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      @endif
    </div>
  </div>
  <hr>
  <br>
  <div class="row">
    <div class="col-6">
      <h4><u>Regiones</u></h4>
      <br>
      @if ($element->regions->isNotEmpty())
        <div class="card">
          <ul class="list-group list-group-flush">
            @foreach ($element->regions as $region)
              <li class="list-group-item">
                <div class="row">
                  <div class="col-10">
                    <span>{{ $region->name }}</span>
                  </div>
                  <div class="col-2">
                    @if($element->can_remove_region())
                      <form action="{{ route('admin.elements.regions.destroy',
                        ['element_id' => $element->id, 'region_id' => $region->id]) }}" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type='submit' class="nav-link btn btn-link" value="{{ $element->id }}">
                          <i class="fas fa-trash text-danger"></i>
                        </button>
                      </form>
                    @endif
                  </div>
                </div>
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
