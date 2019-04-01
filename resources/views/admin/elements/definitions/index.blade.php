@extends('layouts.admin_layout')
@section('content')
  <br>
  <p>
    <a href="{{ route('admin.systems.elements.show', ['system_id' => $element->system_id, 'element_id' => $element->id]) }}">
      <i class="fas fa-arrow-left"></i> Regresar
    </a>
  </p>
  <div class="row">
    <div class="col-12">
      <h1>
        {{ $element->name }}
        <a class="btn btn-primary float-right" href="{{ route('admin.elements.definitions.create', $element->id) }}">
          <i class="fas fa-plus"></i>
          Nueva Definición
        </a>
      </h1>
    </div>
  </div>
  <hr>
  <br>
  <div class="row">
    <div class="col-8">
      <h4><u>Definiciones</u></h4>
      <br>
      @if ($element->definitions->isNotEmpty())
        <div class="card">
          <ul class="list-group list-group-flush">
            @foreach ($element->definitions as $definition)
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12">
                    <span>{{ $definition->definition }}</span>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      @endif
    </div>
@endsection
