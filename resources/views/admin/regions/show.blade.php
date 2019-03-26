
@extends('layout')
@section('content')
  <br>
  <p>
    <a href="{{ route('admin.regions.index') }}">
      <i class="fas fa-arrow-left"></i> Regresar
    </a>
  </p>
  <h1>
    {{ $region->name }}
  </h1>
  <hr>
  <div class="row">
    <div class="col-5">
      @if ($sub_regions->isNotEmpty())
        <div class="card">
          <ul class="list-group list-group-flush">
            @foreach ($sub_regions as $sub_region)
              <li class="list-group-item">
                <div class="row">
                  <div class="col-8">
                    <strong>{{ $sub_region->name }}</strong>
                  </div>
                  <div class="col-4">
                    <div class="row">
                      <a class="nav-link col-4" href="{{ route('admin.regions.show', $sub_region->id) }}">
                        <i class="fas fa-eye"></i>
                      </a>
                      <a class="nav-link col-4" href="{{ route('admin.regions.edit', $sub_region->id) }}">
                        <i class="fas fa-edit text-info"></i>
                      </a>
                      <form action="{{ route('admin.regions.destroy', $sub_region->id) }}" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type='submit' class="nav-link col-4 btn btn-link" value="{{ $sub_region->id }}">
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
        <p>No hay Regiones</p>
      @endif
    </div>
    <div class="col-6 offset-1">
      <?php $data=[
        'form_title' => "Nueva Subregión",
        'parent_id' => $region->id,
        'region_name' => "",
        'method' => 'post',
        'route' => route('admin.regions.store')
      ]?>
      @include('admin.regions.form', $data)
    </div>
  </div>
@endsection
