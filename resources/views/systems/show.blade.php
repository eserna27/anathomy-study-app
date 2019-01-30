@extends('layout')
@section('content')
  <h1>
    {{ $system->name }}
  </h1>
  <hr>
  @if ($system->elements->isNotEmpty())
    <br>
    <div class="row">
      <div class="col-4">
        <div class="list-group" id="list-tab" role="tablist">
          @foreach ($system->elements as $element)
            <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" href="#element-{{$element->id}}" role="tab" aria-controls="home">
              <strong>{{ $element->name }}</strong>
              <br>
              <small>Region {{ $element->region->name }}</small>
            </a>
          @endforeach
        </div>
      </div>
      <div class="col-8">
        <div class="tab-content" id="nav-tabContent">
          <h4>Definiciones</h4>
          @foreach ($system->elements as $element)
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
