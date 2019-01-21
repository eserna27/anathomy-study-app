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
}
