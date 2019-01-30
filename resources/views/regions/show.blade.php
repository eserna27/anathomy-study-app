@extends('layout')
@section('content')
  <h1>
    {{ $region->name }}
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
@endsection
