<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\System;

class SystemsController extends Controller
{
  public function index()
  {
    $systems = System::list_systems();
    return view('admin.systems.index', compact('systems'));
  }
}
