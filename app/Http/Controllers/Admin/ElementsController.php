<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Element;
use App\Models\Region;
use App\Models\System;
use Input;
use Redirect;

class ElementsController extends Controller
{
  public function index()
  {
    $elements = Element::all_roots();
    return view('admin.elements.index', compact('elements'));
  }

  public function show($element_id)
  {
    $system = null;
    $regions_options = Region::options_for_select();
    $element = Element::find($element_id);
    return view('admin.elements.show', compact('system', 'element', 'regions_options'));
  }

  public function create(){
    $system = null;
    $kind_options = Element::kind_options();
    $regions_options = Region::options_for_select();
    $systems_options = System::options_for_select();
    $element = null;
    if(Input::get('element_id'))
    {
      $element = Element::find(Input::get('element_id'));
    }
    return view('admin.elements.create', compact('system', 'kind_options', 'regions_options', 'element', 'systems_options'));
  }

  public function store()
  {
    $element_data = array(
      'name' => Input::get('name'),
      'region_id' => Input::get('region_id'),
      'system_id' => Input::get('system_id'),
      'kind' => Input::get('kind'),
      'parent_id' => Input::get('element_id')
    );
    $element_validator = Element::store_element($element_data);

    if ($element_validator['saved'])
    {
      if(is_null($element_data['parent_id']))
      {
        return Redirect::to(route('admin.elements.index'));
      }else{
        return Redirect::to(route('admin.elements.show', $element_data['parent_id']));
      }
    }else{
      $kind_options = Element::kind_options();
      $systems_options = System::options_for_select();
      return Redirect::to(route('admin.elements.create', compact('system', 'kind_options', 'systems_options')))
        ->withErrors($element_validator['validator']);
    }
  }

  public function destroy($element_id)
  {
    Element::delete_element($element_id);
    return Redirect::to(url()->previous());
  }

  public function edit($element_id)
  {
    $kind_options = Element::kind_options();
    $element = Element::find($element_id);
    $systems_options = System::options_for_select();
    return view('admin.elements.edit', compact('element', 'kind_options', 'systems_options'));
  }

  public function update($element_id)
  {
    $element_data = array(
      'name' => Input::get('name'),
      'kind' => Input::get('kind'),
      'system_id' => Input::get('system_id'),
    );
    $element_validator = Element::update_element($element_id, $element_data);

    if ($element_validator['updated'])
    {
      return Redirect::to(route('admin.elements.show', $element_id));
    }else{
      $kind_options = Element::kind_options();
      $element = Element::find($element_id);
      $systems_options = System::options_for_select();
      return Redirect::to(route('admin.elements.edit', compact('element', 'kind_options', 'systems_options')))
        ->withErrors($element_validator['validator']);
    }
  }
}
