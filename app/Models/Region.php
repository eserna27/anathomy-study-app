<?php

namespace App\Models;

use Validator;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
  protected $fillable = ['name'];

  public static function list_regions()
  {
    return Region::all();
  }

  public static function find_region($id)
  {
    return Region::find($id);
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
