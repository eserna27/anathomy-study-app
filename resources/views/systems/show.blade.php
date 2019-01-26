@extends('layout')
@section('content')
  <h1>
    {{ $system->name }}
  </h1>
  <hr>
  @if ($system->elements->isNotEmpty())
    <h2>Elementos</h2>
    <div class="card" style="width: 18rem;">
      <ul class="list-group list-group-flush">
        @foreach ($system->elements as $element)
          <li class="list-group-item">
            <strong>{{ $element->name }}</strong>
            <br>
            <small>Region {{ $element->region->name }}</small>
          </li>
        @endforeach
      </ul>
    </div>
  @endif
@endsection
