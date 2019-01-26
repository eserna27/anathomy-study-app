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
    <h2>Elementos</h2>
    <div class="card" style="width: 18rem;">
      <ul class="list-group list-group-flush">
        @foreach ($region->elements as $element)
          <li class="list-group-item">
            <strong>{{ $element->name }}</strong>
          </li>
        @endforeach
      </ul>
    </div>
  @endif
@endsection
