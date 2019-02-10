@extends('layout')
@section('content')
  @include('return')
  <h1>
    Regiones
  </h1>
  <hr>
  @if ($regions->isNotEmpty())
    <div class="card" style="width: 18rem;">
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
@endsection
