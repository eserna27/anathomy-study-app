<?php

namespace App\Models;

use Validator;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use App\Models\Element;

class Region extends Model
{
  use NodeTrait;

  const RULES = [
    'name' => 'required|unique:regions',
  ];
  const MESSAGES = [
    'name.required' => "Es obligarorio",
    'name.unique' => "No se puede repetir"
  ];

  protected $fillable = ['name', 'parent_id'];

  public function elements()
  {
    return $this->belongsToMany(Element::class, 'element_regions', 'region_id', 'element_id');
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
    return Region::descendantsOf($region_id);
  }

  public static function store_region($region_data)
  {
    $validatedData = Validator::make(
      $region_data, self::RULES, self::MESSAGES
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
    return Region::destroy($region_id);
  }
}
