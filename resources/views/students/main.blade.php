@extends('layout')
@section('content')
  <h1>
    Bienvenido
  </h1>
  <hr>
  <div class="row">
    <div class="col-6">
      <h3>
        Regiones
      </h3>
      <hr>
      @if ($regions->isNotEmpty())
        <div class="card">
          <ul class="list-group list-group-flush">
            @foreach ($regions as $region)
              <li class="list-group-item">
                <a class="nav-link" href="{{ route('regions.show', $region->id) }}">
                  {{ $region->name }} <span class="sr-only">(current)</span>
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      @else
        <p>No hay Regiones</p>
      @endif
    </div>
    <div class="col-6">
      <h3>
        Sistemas
      </h3>
      <hr>
      @if ($systems->isNotEmpty())
        <div class="card">
          <ul class="list-group list-group-flush">
            @foreach ($systems as $system)
              <li class="list-group-item">
                <a class="nav-link" href="{{ route('systems.show', $system->id) }}">
                  {{ $system->name }} <span class="sr-only">(current)</span>
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      @else
        <p>No hay Sistemas</p>
      @endif
    </div>
  </div>
@endsection
