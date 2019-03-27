@extends('layout')
@section('content')
  @include('return')
  <h1>
    {{ $system->name }}
  </h1>
  <hr>
  @if ($system->show_regions()->isNotEmpty())
    <br>
    <div class="row">
      <div class="col-4">
        <div class="card" style="width: 18rem;">
          <ul class="list-group list-group-flush">
            @forelse ($system->show_regions() as $region)
              <li class="list-group-item">
                <a class="nav-link" href="{{ route('admin.systems.region', ['system_id' => $system->id, 'region_id' => $region->id]) }}">
                  <strong>Region {{ $region->name }}</strong> <span class="sr-only">(current)</span>
                </a>
              </li>
            @empty
                <p>No hay Regiones.</p>
            @endforelse
          </ul>
        </div>
      </div>
    </div>
  @endif
@endsection
