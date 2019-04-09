@extends('layouts.admin_layout')
@section('content')
  @include('return')
  <h1>
    @if(is_null($element))
      <small>Nuevo Elemento</small>
    @else
      Agregar parte a {{$element->name}}
    @endif
  </h1>
  <hr>
  <br>
  <div class="row">
    <div class="col-4">
      <?php
        $element_id = null;
        if(!is_null($element)){$element_id = $element->id;}
        $data=[
          'form_title' => "",
          'element' => $element,
          'method' => 'post',
          "kind_options" => $kind_options,
          'route' => route('admin.elements.store')
        ]
      ?>
      @include('admin.elements.form', $data)
    </div>
  </div>
@endsection
