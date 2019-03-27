@extends('layout')
@section('content')
  @include('return')
  <h1>
    {{ $system->name }} - <small>Region {{ $region->name}}</small>
  </h1>
  <hr>
  @if ($system->show_regions()->isNotEmpty())
    <br>
    <div class="row">
      <div class="col-4">
        @if ($region->elements->isNotEmpty())
          <div class="card" style="width: 18rem;">
            <ul class="list-group list-group-flush">
              @foreach ($region->elements as $element)
                <li class="list-group-item">
                  <a class="nav-link" href="{{ route('admin.systems.region.element',
                    ['system_id' => $system->id,
                     'region_id' => $region->id,
                     'element_id' => $element->id]) }}">
                    <strong>{{ $element->name }}</strong> <span class="sr-only">(current)</span>
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
        @else
          No hay elementos
        @endif
      </div>
    </div>
  @endif
@endsection
