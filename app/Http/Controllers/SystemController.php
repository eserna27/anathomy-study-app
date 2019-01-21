<?php

namespace App\Http\Controllers;
use App\Models\System;

use Illuminate\Http\Request;

class SystemController extends Controller
{
  public function index()
  {
    $systems = System::list_systems();
    return view('systems.index', compact('systems'));
  }
}
