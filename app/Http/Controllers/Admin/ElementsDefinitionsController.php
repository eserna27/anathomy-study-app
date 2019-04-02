<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Element;
use App\Models\Definition;
use Input;
use Redirect;

class ElementsDefinitionsController extends Controller
{
  public function create($element_id)
  {
    $element = Element::find($element_id);
    return view('admin.elements.definitions.create', compact('element'));
  }

  public function index($element_id)
  {
    $element = Element::find($element_id);
    return view('admin.elements.definitions.index', compact('element'));
  }

  public function store($element_id)
  {
    $data = [
      'element_id' => $element_id,
      'definition' => Input::get('definition')
    ];
    $saved_response = Definition::store_definition($data);
    $element = Element::find($element_id);
    if($saved_response['saved'])
    {
      return view('admin.elements.definitions.index', compact('element'));
    }else {
      return view('admin.elements.definitions.create', compact('element'))->withErrors($saved_response['validator']);
    }
  }
}
