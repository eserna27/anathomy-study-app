<?php

namespace App\Models;

use Validator;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{
  protected $fillable = ['name'];

  public function elements()
  {
    return $this->hasMany(Element::class, 'system_id', 'id');
  }

  public static function list_systems()
  {
    return System::all();
  }

  public function show_regions()
  {
    return $this->elements()->with(['regions'])->get()->map(function($element, $key) {
      return $element->regions->map(function($region, $keys) {
        if ($region->parent){
          return $region->parent;
        }else{
          return $region;
        }
      });
    })->flatten(1)->unique('id')->filter()->flatten(1);
  }

  public static function store_system($system_data)
  {
    $validatedData = Validator::make($system_data, [
      'name' => 'required|unique:systems',
    ],
    [
      'name.required' => "Es obligarorio",
      'name.unique' => "No se puede repetir"
    ]);

    if ($validatedData->fails()){
      return $validatedData;
    }
    else{
      System::create($system_data);
    }
  }

  public static function find_system($id)
  {
    return System::find($id);
  }
}
