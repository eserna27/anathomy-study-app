@extends('layouts.admin_layout')
@section('content')
  <br>
  <p>
    <a href="{{ route('admin.systems.elements.show', ['system_id' => $element->system_id, 'element_id' => $element->id]) }}">
      <i class="fas fa-arrow-left"></i> Regresar
    </a>
  </p>
  <div class="row">
    <div class="col-12">
      <h1>
        <small>Nueva definición para </small><strong>{{ $element->name }}</strong>
      </h1>
    </div>
  </div>
  <hr>
  <br>
  <div class="row">
    <div class="col-8">
      @include('admin.elements.definitions.form')
    </div>
@endsection
