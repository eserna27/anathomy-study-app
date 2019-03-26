<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\System;
use Input;
use Redirect;

class SystemsController extends Controller
{
  public function index()
  {
    $systems = System::list_systems();
    return view('admin.systems.index', compact('systems'));
  }

  public function destroy($system_id)
  {
    System::delete_system($system_id);
    return Redirect::to(url()->previous());
  }
}
