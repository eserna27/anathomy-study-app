<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\System;

class StudentController extends Controller
{
  public function main()
  {
    $regions = Region::list_regions();
    $systems = System::list_systems();
    return view('students.main', compact('regions', 'systems'));
  }
}
