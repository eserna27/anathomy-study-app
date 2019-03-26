@extends('layouts.admin_layout')
@section('content')
  <br>
  <p>
    <a href="{{ route('admin.home') }}">
      <i class="fas fa-arrow-left"></i> Regresar
    </a>
  </p>
  <h1>
    Sistemas
  </h1>
  <hr>
  <div class="row">
    <div class="col-5">
      @if ($systems->isNotEmpty())
        <div class="card">
          <ul class="list-group list-group-flush">
            @foreach ($systems as $system)
              <li class="list-group-item">
                <div class="row">
                  <div class="col-8">
                    <strong>{{ $system->name }}</strong>
                  </div>
                  <div class="col-4">
                    <div class="row">
                      <a class="nav-link col-4" href="{{ route('admin.systems.show', $system->id) }}">
                        <i class="fas fa-eye"></i>
                      </a>
                      <a class="nav-link col-4" href="{{ route('admin.systems.edit', $system->id) }}">
                        <i class="fas fa-edit text-info"></i>
                      </a>
                      <form action="{{ route('admin.systems.destroy', $system->id) }}" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type='submit' class="nav-link col-4 btn btn-link" value="{{ $system->id }}">
                          <i class="fas fa-trash text-danger"></i>
                        </button>
                      </form>
                    </div>
                  </div>
              </li>
            @endforeach
          </ul>
        </div>
      @else
        <p>No hay Sistemas</p>
      @endif
    </div>
  </div>
@endsection
