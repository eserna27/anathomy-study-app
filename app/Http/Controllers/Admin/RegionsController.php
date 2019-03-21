<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Region;
use Input;
use Redirect;

class RegionsController extends Controller
{
  public function index()
  {
    $regions = Region::list_regions();
    return view('admin.regions.index', compact('regions'));
  }

  public function show($id)
  {
    $region = Region::find_region($id);
    $sub_regions = Region::list_sub_regions_for_region($region->id);
    return view('admin.regions.show', compact('region', 'sub_regions'));
  }

  public function store()
  {
    $region_data = array(
      'name' => Input::get('name')
    );
    $region_validator = Region::store_region($region_data);
    if($region_validator->fails())
    {
      return Redirect::to(route('admin.regions.index'))
          ->withErrors($region_validator);
    }else
    {
      return view(route('admin.regions.index'));
    }
  }
}
