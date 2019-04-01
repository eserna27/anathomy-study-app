<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\System;
use App\Models\Region;
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

  public function store()
  {
    $system_data = array(
      'name' => Input::get('name')
    );
    $system_validator = System::store_system($system_data);
    return Redirect::to(route('admin.systems.index'))
      ->withErrors($system_validator);
  }

  public function edit($system_id)
  {
    $system = System::find_system($system_id);
    return view('admin.systems.edit', compact('system'));
  }

  public function update($system_id)
  {
    $system_data = array(
      'name' => Input::get('name')
    );
    $system_validator = System::update_system($system_id, $system_data);
    return Redirect::to(route('admin.systems.index'))
      ->withErrors($system_validator);
  }

  public function show($system_id)
  {
    $system = System::find_system($system_id);
    return view('admin.systems.show', compact('system'));
  }
}
