@extends('layout')
@section('content')
  <h1>
    Sistemas
  </h1>
  <hr>
  <div class="card" style="width: 18rem;">
    <ul class="list-group list-group-flush">
      <li class="list-group-item">
        <a class="nav-link" href="{{route('regions.index')}}">
          Circulatorio <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="list-group-item">
        <a class="nav-link" href="{{route('systems.index')}}">
          Digestivo <span class="sr-only">(current)</span>
        </a>
      </li>
    </ul>
  </div>
@endsection
