@extends('layout')
@section('content')
  @include('return')
  <h1>
    {{ $system->name }}
  </h1>
  <hr>
  <h3>
    Regiones
  </h3>
  <br>
  @if ($system->show_regions_with_elements()->isNotEmpty())
      <div class="row">
        @foreach ($system->show_regions_with_elements() as $region_with_element)
          <div class="col-4">
            <div class="card" style="margin-bottom: 20px;">
              <div class="card-body">
                <h5 class="card-title">
                  <a class="nav-link" href="{{ route('regions.show', $region_with_element['region']->id) }}">
                    @if($region_with_element['region']->parent)<small>{{ $region_with_element['region']->parent->name }} -</small>@endif
                    {{ $region_with_element['region']->name }}
                  </a>
                </h5>
                <ul class="list-group list-group-flush">
                  @if($region_with_element['elements']->isNotEmpty())
                    @foreach($region_with_element['elements'] as $element)
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-10">
                            <strong>{{ $element->name }}</strong>
                          </div>
                        </div>
                      </li>
                    @endforeach
                  @else
                    <li class="list-group-item">
                      <strong>No hay elementos</strong>
                    </li>
                  @endif
                </ul>
              </div>
            </div>
          </div>
        @endforeach
      </div>
  @endif
@endsection
