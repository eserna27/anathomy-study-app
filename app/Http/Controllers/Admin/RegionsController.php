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
    if(Input::has('region_id'))
    {
      $region_data = array(
        'name' => Input::get('name'),
        'parent_id' => Input::get('region_id')
      );
      $region_validator = Region::store_region($region_data);
      return Redirect::to(route('admin.regions.show', $region_data['parent_id']))
        ->withErrors($region_validator);
    }else{
      $region_data = array(
        'name' => Input::get('name')
      );
      $region_validator = Region::store_region($region_data);
      return Redirect::to(route('admin.regions.index'))
        ->withErrors($region_validator);
    }
  }

  public function destroy($region_id)
  {
    Region::delete_region($region_id);
    return Redirect::to(url()->previous());
  }

  public function edit($region_id)
  {
    $region = Region::find_region($region_id);
    $parent_id = $region->parent_id;
    $sub_regions = Region::list_sub_regions_for_region($region_id);
    return view('admin.regions.edit', compact('region', 'sub_regions', 'parent_id'));
  }

  public function update($region_id)
  {
    if(Input::has('region_id'))
    {
      $region_data = array(
        'name' => Input::get('name'),
        'parent_id' => Input::get('region_id')
      );
      $region_validator = Region::update_region($region_id, $region_data);
      return Redirect::to(route('admin.regions.show', $region_data['parent_id']))
        ->withErrors($region_validator);
    }else{
      $region_data = array(
        'name' => Input::get('name')
      );
      $region_validator = Region::update_region($region_id, $region_data);
      return Redirect::to(route('admin.regions.index'))
        ->withErrors($region_validator);
    }
  }
}
