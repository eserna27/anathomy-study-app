@extends('layout')
@section('content')
  <h1>
    Bienvenido
  </h1>
  <hr>
  <div class="card" style="width: 18rem;">
    <ul class="list-group list-group-flush">
      <li class="list-group-item">
        <a class="nav-link" href="{{route('regions.index')}}">
          Regiones <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="list-group-item">
        <a class="nav-link" href="{{route('systems.index')}}">
          Sistemas <span class="sr-only">(current)</span>
        </a>
      </li>
    </ul>
  </div>
@endsection
