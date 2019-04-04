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
      <div class="col-3">
        <div class="list-group" id="list-tab" role="tablist">
          @foreach ($region->elements as $element)
            <a class="list-group-item list-group-item-action" id="list-elements-list" data-toggle="list" href="#element-{{$element->id}}" role="tab" aria-controls="elements">
              <strong>{{ $element->name }}</strong>
              <br>
              <small>{{ $element->system->name }}</small>
            </a>
          @endforeach
        </div>
      </div>
      <div class="col-9">
        <div class="tab-content" id="nav-tabContent">
          <h4>Definiciones</h4>
          @foreach ($region->elements as $element)
            <div class="tab-pane fade" id="element-{{$element->id}}" role="tabpanel" aria-labelledby="list-elements-list">
              <ul class="list-group list-group-flush">
                @foreach ($element->definitions as $definition)
                  <li class="list-group-item">
                    {{ $definition->definition }}
                  </li>
                @endforeach
              </ul>
              <hr>
              <h3>Partes</h3>
              <ul class="list-group list-group-flush" style="width: 50%">
                @foreach ($element->parts_for_region($region->id) as $parts)
                  <li class="list-group-item">
                    {{ $parts->name }}
                  </li>
                @endforeach
              </ul>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  @endif
  <div class="row" style="margin-top: 100px;">
    <div class="col-6">
      @if ($region->show_systems_with_elements()->isNotEmpty())
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">
              Sistemas relacionados
            </h5>
            <ul class="list-group list-group-flush">
              @foreach ($region->show_systems_with_elements() as $system_with_elements)
                <li class="list-group-item">
                  <a class="nav-link" href="{{ route('systems.show', $system_with_elements['system']->id) }}">
                    {{ $system_with_elements['system']->name }}
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif
    </div>
    <div class="col-6">
      @if ($region->related_regions()->isNotEmpty())
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">
              Regiones relacionadas
            </h5>
            <ul class="list-group list-group-flush">
              @foreach ($region->related_regions() as $region_related)
                <li class="list-group-item">
                  <a class="nav-link" href="{{ route('regions.show', $region_related->id) }}">
                    {{ $region_related->name }}
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif
    </div>
  </div>
@endsection
