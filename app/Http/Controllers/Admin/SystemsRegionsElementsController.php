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
  public function show($system_id, $element_id)
  {
    $system = System::find_system($system_id);
    $regions_options = Region::options_for_select();
    $element = Element::find($element_id);
    return view('admin.elements_for_region_and_systems.show', compact('system', 'element', 'regions_options'));
  }
}
