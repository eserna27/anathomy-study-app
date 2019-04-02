@extends('layout')
@section('content')
  @include('return')
  <h1>
    {{ $region->name }}@if($region->parent)<small> - {{ $region->parent->name }}</small>@endif
  </h1>
  <hr>
  @if ($sub_regions->isNotEmpty())
    <div class="card" style="width: 18rem;">
      <ul class="list-group list-group-flush">
        @foreach ($sub_regions as $sub_region)
          <li class="list-group-item">
            <a class="nav-link" href="{{ route('regions.show', $sub_region->id) }}">
              {{ $sub_region->name }} <span class="sr-only">(current)</span>
            </a>
          </li>
        @endforeach
      </ul>
    </div>
  @endif
  @if ($region->elements->isNotEmpty())
    <br>
    <div class="row">
      <div class="col-4">
        <div class="list-group" id="list-tab" role="tablist">
          @foreach ($region->elements as $element)
            <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" href="#element-{{$element->id}}" role="tab" aria-controls="home">
              <strong>{{ $element->name }}</strong>
              <br>
              <small>{{ $element->system->name }}</small>
            </a>
          @endforeach
        </div>
      </div>
      <div class="col-8">
        <div class="tab-content" id="nav-tabContent">
          <h4>Definiciones</h4>
          @foreach ($region->elements as $element)
            <div class="tab-pane fade show" id="element-{{$element->id}}" role="tabpanel" aria-labelledby="list-home-list">
              <ul class="list-group list-group-flush">
                @foreach ($element->definitions as $definition)
                  <li class="list-group-item">
                    {{ $definition->definition }}
                  </li>
                @endforeach
              </ul>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  @endif
  <br>
  <br>
  @if ($region->show_systems_with_elements()->isNotEmpty())
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">
              Sistemas relacionados
            </h5>
            <hr>
            <ul class="list-group list-group-flush">
              @foreach ($region->show_systems_with_elements() as $system_with_elements)
                <a class="nav-link" href="{{ route('systems.show', $system_with_elements['system']->id) }}">
                  {{ $system_with_elements['system']->name }}
                </a>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  @endif
@endsection
