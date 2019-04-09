@extends('layout')
@section('content')
  @include('return')
  <h1>
    Sistemas
  </h1>
  <hr>
  @if ($systems->isNotEmpty())
    <div class="row">
      <div class="col-12 col-md-12 col-lg-6">
        <div class="card">
          <ul class="list-group list-group-flush">
            @foreach ($systems as $system)
              <li class="list-group-item">
                <a class="nav-link" href="{{ route('systems.show', $system->id) }}">
                  {{ $system->name }} <span class="sr-only">(current)</span>
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  @else
    <p>No hay Sistemas</p>
  @endif
@endsection
