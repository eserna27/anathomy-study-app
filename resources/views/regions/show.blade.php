@extends('layout')
@section('content')
  <br>
  <p>
    <a href="{{$return_url}}">
      <i class="fas fa-arrow-left"></i> Regresar
    </a>
  </p>
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
        <h4>Elementos</h4>
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
              <div class="row">
                <div class="col-4">
                  <div class="list-group" id="list-tab" role="tablist">
                    @foreach ($element->parts_for_region($region->id) as $part)
                      <a class="list-group-item list-group-item-action" id="list-part-{{$part->id}}-item" data-toggle="list" href="#list-part-{{$part->id}}" role="tab" aria-controls="part">
                        {{ $part->name }}
                      </a>
                      @foreach ($part->list_elements_with_childs($region->id) as $part_child)
                        <a class="list-group-item list-group-item-action" id="list-part-{{$part_child['element']->id}}-item"
                          data-toggle="list" href="#list-part-{{$part_child['element']->id}}"
                          role="tab" aria-controls="part" style="width: 95%; margin-left: 5%;">
                          {{$part_child['element']->name}}
                        </a>
                        @foreach ($part_child['childs'] as $part_child_child)
                          <a class="list-group-item list-group-item-action" id="list-part-{{$part_child_child->id}}-item"
                            data-toggle="list" href="#list-part-{{$part_child_child->id}}"
                            role="tab" aria-controls="part" style="width: 90%; margin-left: 10%;">
                            {{$part_child_child->name}}
                          </a>
                        @endforeach
                      @endforeach
                    @endforeach
                  </div>
                </div>
                <div class="col-8">
                  <div class="tab-content" id="nav-tabContent">
                    @foreach ($element->parts_for_region($region->id) as $part)
                      <div class="tab-pane fade" id="list-part-{{$part->id}}" role="tabpanel" aria-labelledby="list-part-{{$part->id}}-item">
                        @foreach ($part->definitions as $definition)
                          <p>{{$definition->definition}}</p>
                        @endforeach
                      </div>
                    @endforeach
                    @foreach ($element->parts_for_region($region->id) as $part)
                      <div class="tab-pane fade" id="list-part-{{$part->id}}" role="tabpanel" aria-labelledby="list-part-{{$part->id}}-item">
                        @foreach ($part->definitions as $definition)
                          <p>{{$definition->definition}}</p>
                        @endforeach
                      </div>
                      @foreach ($part->list_elements_with_childs($region->id) as $part_child)
                        <div class="tab-pane fade" id="list-part-{{$part_child['element']->id}}" role="tabpanel" aria-labelledby="list-part-{{$part_child['element']->id}}-item">
                          @foreach ($part_child['element']->definitions as $definition)
                            <p>{{$definition->definition}}</p>
                          @endforeach
                        </div>
                        @foreach ($part_child['childs'] as $part_child_child)
                          <div class="tab-pane fade" id="list-part-{{$part_child_child->id}}" role="tabpanel" aria-labelledby="list-part-{{$part_child_child->id}}-item">
                            @foreach ($part_child_child->definitions as $definition)
                              <p>{{$definition->definition}}</p>
                            @endforeach
                          </div>
                        @endforeach
                      @endforeach
                    @endforeach
                  </div>
                </div>
              </div>
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
