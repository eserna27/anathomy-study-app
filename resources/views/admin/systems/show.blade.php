@extends('layouts.admin_layout')
@section('content')
  <br>
  <p>
    <a href="{{ route('admin.systems.index') }}">
      <i class="fas fa-arrow-left"></i> Regresar
    </a>
  </p>
  <div class="row">
    <div class="col-12">
      <h1>
        {{ $system->name }}
        <a class="btn btn-primary float-right" href="{{ route('admin.systems.elements.create', $system->id) }}">
          <i class="fas fa-plus"></i>
          Nuevo Elemento
        </a>
      </h1>
    </div>
  </div>
  <hr>
  @if ($system->elements->isNotEmpty())
    <div class="row">
      <div class="col-8">
        @if ($system->show_regions()->isNotEmpty())
          <div class="card" style="width: 18rem;">
            <ul class="list-group list-group-flush">
              @foreach ($system->elements as $element)
                <li class="list-group-item">
                  <a class="nav-link" href="{{ route('admin.systems.elements.show',
                    ['system_id' => $system->id,
                     'element_id' => $element->id]) }}">
                    <strong>{{ $element->name }}</strong> <span class="sr-only">(current)</span>
                    <br>
                    <small>{{ $element->regions->implode('name', ', ') }}</small>
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
        @endif
      </div>
    </div>
  @endif
@endsection
