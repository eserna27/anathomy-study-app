@extends('layouts.admin_layout')
@section('content')
  @include('return')
  <h1>
    {{ $system->name }} - <small>Nuevo Elemento</small>
  </h1>
  <hr>
  <br>
  <div class="row">
    <div class="col-4">
      <?php $data=[
        'form_title' => "",
        'system_name' => null,
        'method' => 'post',
        "kind_options" => $kind_options,
        'route' => route('admin.systems.elements.store',
          ['system_id' => $system->id])
      ]?>
      @include('admin.elements.form', $data)
    </div>
  </div>
@endsection
