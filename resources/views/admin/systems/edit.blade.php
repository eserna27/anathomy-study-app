@extends('layout')
@section('content')
  <br>
  <p>
    <a href="{{ route('admin.systems.index') }}">
      <i class="fas fa-arrow-left"></i> Regresar
    </a>
  </p>
  <h1>
    Editar {{ $system->name }}
  </h1>
  <hr>
  <div class="row">
    <div class="col-6">
      <?php $data=[
        'form_title' => "",
        'system_name' => $system->name,
        'method' => 'patch',
        'route' => route('admin.systems.update', $system->id)
      ]?>
      @include('admin.systems.form', $data)
    </div>
  </div>
@endsection
