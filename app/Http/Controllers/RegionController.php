<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use Input;

class RegionController extends Controller
{
  public function index()
  {
    $regions = Region::list_regions();
    return view('regions.index', compact('regions'));
  }

  public function show($id)
  {
    $region = Region::find_region($id);
    $sub_regions = Region::list_sub_regions_for_region($region->id);
    $return_url = route('regions.index');
    if($region->parent_id){
      $return_url = route('regions.show', $region->parent_id);
    }
    if(Input::get('system_id')){
      $return_url = route('systems.show', Input::get('system_id'));
    }
    return view('regions.show', compact('region', 'sub_regions', 'return_url'));
  }
}
