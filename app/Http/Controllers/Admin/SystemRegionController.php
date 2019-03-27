<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\System;
use App\Models\Region;
use Input;
use Redirect;

class SystemRegionController extends Controller
{
  public function show($system_id, $region_id)
  {
    $system = System::find_system($system_id);
    $region = Region::find_region($region_id);
    return view('admin.systems.show_region', compact('system', 'region'));
  }
}
