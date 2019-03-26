@extends('layout')
@section('content')
  <br>
  <p>
    <a href="{{ route('admin.regions.index') }}">
      <i class="fas fa-arrow-left"></i> Regresar
    </a>
  </p>
  <h1>
    Editar {{ $region->name }}
  </h1>
  <hr>
  <div class="row">
    <div class="col-6">
      <?php $data=[
        'form_title' => "",
        'region_id' => $region->id,
        'parent_id' => $parent_id,
        'region_name' => $region->name,
        'method' => 'patch',
        'route' => route('admin.regions.update', $region->id)
      ]?>
      @include('admin.regions.form', $data)
    </div>
  </div>
@endsection
