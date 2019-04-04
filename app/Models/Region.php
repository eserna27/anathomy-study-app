<?php

namespace App\Models;

use Validator;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use App\Models\Element;

class Region extends Model
{
  use NodeTrait;

  const MESSAGES = [
    'name.required' => "Es obligarorio",
    'name.unique' => "No se puede repetir"
  ];

  protected $fillable = ['name', 'parent_id'];

  protected static $rules = [
    'name' => 'required|unique:regions',
  ];

  public function elements()
  {
    return $this->belongsToMany(Element::class, 'element_regions', 'region_id', 'element_id')->where(['parent_id' => null]);
  }

  public function show_systems_with_elements()
  {
    return $this->elements->map(function($element){
      return [
        'system' => $element->system,
        'elements' => $this->elements()->where(['system_id' => $element->system->id])->get()
      ];
    })->unique(function ($item) {
        return $item['system']->id;
    });
  }

  public function related_regions()
  {
    return $this->elements->map(function($element){
      return $element->element_with_descendants()->map(function($element){
        return $element->regions;
      })->flatten(1);
    })->flatten(1)->unique('id');
  }

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
    return Region::find($region_id)->children;
  }

  public static function store_region($region_data)
  {
    $validatedData = Validator::make(
      $region_data, Region::$rules, self::MESSAGES
    );

    if ($validatedData->fails()){
      return $validatedData;
    }
    else{
      Region::create($region_data);
      return $validatedData;
    }
  }

  public static function delete_region($region_id)
  {
    ElementRegion::where(['region_id' => $region_id])->delete();
    return Region::destroy($region_id);
  }

  public static function update_region($region_id, $region_data)
  {
    $rules = Region::$rules;
    $rules['name'] = $rules['name'] . ',id,' . $region_id;
    $validatedData = Validator::make(
      $region_data, $rules, self::MESSAGES
    );

    if ($validatedData->fails()){
      return $validatedData;
    }else{
      Region::find($region_id)->update($region_data);
      return $validatedData;
    }
  }

  public static function options_for_select()
  {
    return Region::all()->mapWithKeys(function($region, $key) {
      return [$region->id => Region::name_for_select($region)];
    })->toArray();
  }

  public static function name_for_select($region)
  {
    $region_parent = $region->parent;
    if (is_null($region_parent))
    {
      return "$region->name";
    }else{
      return "$region_parent->name - $region->name";
    }
  }
}
