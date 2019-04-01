<?php

namespace App\Models;

use Validator;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{

  const MESSAGES = [
    'name.required' => "Es obligarorio",
    'name.unique' => "No se puede repetir"
  ];

  protected $fillable = ['name'];

  protected static $rules = [
    'name' => 'required|unique:systems',
  ];

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
    })->flatten(1)->unique('id')->flatten(1);
  }

  public function show_regions_with_elements()
  {
    return $this->elements()->with(['regions'])->get()->map(function($element) {
      return $element->regions->map(function($region){
        return ["$region->name" => $region->elements()->where(['system_id'=>$this->id])->get()];
      });
    })->flatten(1)->unique(function ($item) {
        return key($item);
    });
  }

  public static function store_system($system_data)
  {
    $validatedData = Validator::make($system_data, System::$rules, self::MESSAGES);

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

  public static function delete_system($system_id)
  {
    return System::destroy($system_id);
  }

  public static function update_system($system_id, $system_data)
  {
    $rules = System::$rules;
    $rules['name'] = $rules['name'] . ',id,' . $system_id;
    $validatedData = Validator::make($system_data, $rules, self::MESSAGES);

    if ($validatedData->fails()){
      return $validatedData;
    }else{
      System::find($system_id)->update($system_data);
      return $validatedData;
    }
  }
}
