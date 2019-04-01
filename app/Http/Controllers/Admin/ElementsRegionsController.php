<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Element;
use App\Models\ElementRegion;
use App\Models\System;
use App\Models\Region;
use Input;
use Redirect;

class ElementsRegionsController extends Controller
{
  public function store($element_id)
  {
    $data = array(
      'element_id' => $element_id,
      'region_id' => Input::get('region')
    );
    $validator = ElementRegion::add_region($data);

    $element = Element::find($element_id);
    $system = System::find_system($element->system_id);
    $regions_options = Region::options_for_select();

    return Redirect::to(route('admin.systems.elements.show', compact('system', 'element', 'regions_options')))
      ->withErrors($validator);
  }

  public function destroy($element_id, $region_id)
  {
    ElementRegion::remove_element_for_region($element_id, $region_id);
    return Redirect::to(url()->previous());
  }
}
