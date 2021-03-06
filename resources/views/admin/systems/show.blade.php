@extends('layouts.admin_layout')
@section('content')
  <br>
  <p>
    <a href="{{ route('admin.systems.index') }}">
      <i class="fas fa-arrow-left"></i> Regresar
    </a>
  </p>
  <div class="row">
    <div class="col-12">
      <h1>
        {{ $system->name }}
        <a class="btn btn-primary float-right" href="{{ route('admin.systems.elements.create', $system->id) }}">
          <i class="fas fa-plus"></i>
          Nuevo Elemento
        </a>
      </h1>
    </div>
  </div>
  <hr>
  @if ($system->show_regions_with_elements()->isNotEmpty())
      <div class="row">
        @foreach ($system->show_regions_with_elements() as $region_with_element)
          <div class="col-4">
            <div class="card" style="margin-bottom: 20px;">
              <div class="card-body">
                <h5 class="card-title">
                  @if($region_with_element['region']->parent)<small> {{ $region_with_element['region']->parent->name }} - </small>@endif {{ $region_with_element['region']->name }}
                </h5>
                <ul class="list-group list-group-flush">
                  @if($region_with_element['elements']->isNotEmpty())
                    @foreach($region_with_element['elements'] as $element)
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-10">
                            <a class="nav-link" href="{{ route('admin.systems.elements.show',
                              ['system_id' => $system->id,
                               'element_id' => $element->id]) }}">
                              <strong>{{ $element->name }}</strong> <span class="sr-only">(current)</span>
                            </a>
                          </div>
                          <div class="col-2">
                            {{-- <form action="{{ route('admin.systems.elements.destroy',
                              ['system_id' => $system->id, 'element_id' => $element->id]) }}" method="POST">
                              {{ method_field('DELETE') }}
                              {{ csrf_field() }}
                              <button type='submit' class="nav-link btn btn-link" value="{{ $element->id }}">
                                <i class="fas fa-trash text-danger"></i>
                              </button>
                            </form> --}}
                            <a class="nav-link" href="{{ route('admin.systems.elements.edit',
                              ['system_id' => $system->id,
                               'element_id' => $element->id]) }}">
                              <i class="fas fa-edit text-info"></i>
                            </a>
                          </div>
                        </div>
                      </li>
                    @endforeach
                  @else
                    <li class="list-group-item">
                      <strong>No hay elementos</strong>
                    </li>
                  @endif
                </ul>
              </div>
            </div>
          </div>
        @endforeach
      </div>
  @endif
@endsection
