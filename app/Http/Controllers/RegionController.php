<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;

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
    return view('regions.show', compact('region', 'sub_regions'));
  }
}
