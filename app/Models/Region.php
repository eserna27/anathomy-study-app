<?php

namespace App\Models;

use Validator;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Region extends Model
{
  use NodeTrait;
  protected $fillable = ['name'];

  public static function list_regions()
  {
    return Region::whereIsRoot()->get();
  }

  public static function find_region($id)
  {
    return Region::find($id);
  }

  public static function list_sub_regions_for_region($region_id)
  {
    return Region::descendantsOf($region_id);
  }

  public static function store_region($region_data)
  {
    $validatedData = Validator::make($region_data, [
      'name' => 'required|unique:regions',
    ],
    [
      'name.required' => "Es obligarorio",
      'name.unique' => "No se puede repetir"
    ]);

    if ($validatedData->fails()){
      return $validatedData;
    }
    else{
      Region::create($region_data);
    }
  }
}
