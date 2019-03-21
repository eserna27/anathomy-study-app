@extends('layouts.admin_layout')
@section('content')
  <h1>
    Administrador
  </h1>
  <hr>
  <div class="card" style="width: 18rem;">
    <ul class="list-group list-group-flush">
      <li class="list-group-item">
        <a class="nav-link" href="{{ route('admin.regions.index') }}">
          Regiones
        </a>
      </li>
    </ul>
  </div>
@endsection
