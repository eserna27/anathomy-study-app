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
    <a class="btn btn-primary float-right" href="{{ route('admin.elements.create') }}">
      <i class="fas fa-plus"></i>
      Nuevo Elemento
    </a>
  </h1>
  <hr>
  <div class="row">
    <div class="col-5">
      @if ($elements->isNotEmpty())
        <div class="card">
          <ul class="list-group list-group-flush">
            @foreach ($elements as $element)
              <li class="list-group-item">
                <div class="row">
                  <div class="col-8">
                    <strong>{{ $element->name }}</strong>
                  </div>
                  <div class="col-4">
                    <div class="row">
                      <a class="nav-link col-4" href="{{ route('admin.elements.show', $element->id) }}">
                        <i class="fas fa-eye"></i>
                      </a>
                      <a class="nav-link col-4" href="{{ route('admin.elements.edit', $element->id) }}">
                        <i class="fas fa-edit text-info"></i>
                      </a>
                      <form action="{{ route('admin.elements.destroy', $element->id) }}" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type='submit' class="nav-link col-4 btn btn-link" value="{{ $element->id }}">
                          <i class="fas fa-trash text-danger"></i>
                        </button>
                      </form>
                    </div>
                  </div>
              </li>
            @endforeach
          </ul>
        </div>
      @else
        <p>No hay Elementos</p>
      @endif
    </div>
  </div>
@endsection
