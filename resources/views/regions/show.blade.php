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
            <a class="list-group-item list-group-item-action" id="list-elements-list" data-toggle="list" href="#element-{{$element->id}}" role="tab" aria-controls="elements">
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
            <div class="tab-pane fade show" id="element-{{$element->id}}" role="tabpanel" aria-labelledby="list-elements-list">
              <ul class="list-group list-group-flush">
                @foreach ($element->definitions as $definition)
                  <li class="list-group-item">
                    {{ $definition->definition }}
                  </li>
                @endforeach
              </ul>
              <br>
              @if($element->parts()->isNotEmpty())
                <div class="row">
                  <div class="col-4">
                    <h5>Partes</h5>
                    <div class="list-group" id="list-tab-parts" role="tablist">
                      @foreach ($element->parts() as $part)
                        <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" href="#part-{{$part->id}}" role="tab" aria-controls="parts">
                          <strong>{{ $part->name }}</strong>
                        </a>
                      @endforeach
                    </div>
                  </div>
                  <div class="col-8">
                    <div class="tab-content" id="nav-tabContent">
                      <h5>Definiciones de las partes</h5>
                      @foreach ($element->parts() as $part)
                        <div class="tab-pane fade" id="part-{{$part->id}}" role="tabpanel" aria-labelledby="list-parts-list">
                          <ul class="list-group list-group-flush">
                            @foreach ($part->definitions as $definition)
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
            </div>
          @endforeach
        </div>
      </div>
    </div>
  @endif
  <br>
  <br>
  <div class="row">
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
