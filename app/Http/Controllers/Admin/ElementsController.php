<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\System;
use App\Models\Region;
use App\Models\Element;
use Input;
use Redirect;

class ElementsController extends Controller
{
  public function create($system_id){
    $system = System::find_system($system_id);
    $kind_options = Element::kind_options();
    $regions_options = Region::options_for_select();
    return view('admin.elements.create', compact('system', 'kind_options', 'regions_options'));
  }

  public function show($system_id, $element_id)
  {
    $system = System::find_system($system_id);
    $regions_options = Region::options_for_select();
    $element = Element::find($element_id);
    return view('admin.elements.show', compact('system', 'element', 'regions_options'));
  }

  public function store($system_id)
  {
    $element_data = array(
      'name' => Input::get('name'),
      'region_id' => Input::get('region_id'),
      'system_id' => $system_id,
      'kind' => Input::get('kind')
    );
    $element_validator = Element::store_element($element_data);
    $system = System::find_system($system_id);

    if ($element_validator['saved'])
    {
      return Redirect::to(route('admin.systems.show', compact('system')));
    }else{
      $kind_options = Element::kind_options();
      return Redirect::to(route('admin.systems.elements.create', compact('system', 'kind_options')))
        ->withErrors($element_validator['validator']);
    }
  }

  public function destroy($system_id, $element_id)
  {
    Element::delete_element($element_id);
    return Redirect::to(url()->previous());
  }
}
