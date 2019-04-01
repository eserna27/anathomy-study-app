<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class ElementRegion extends Model
{
  protected $fillable = ['element_id', 'region_id'];

  protected static $rules = [
    'region_id' => 'required',
  ];

  const MESSAGES = [
    'region_id.required' => "Es obligarorio",
  ];

  public static function add_region($data)
  {
    $rules = ElementRegion::$rules;
    $validatedData = Validator::make(
      $data, $rules, self::MESSAGES
    );

    if ($validatedData->fails()){
      return $validatedData;
    }else{
      ElementRegion::create($data);
      return $validatedData;
    }
  }

  public static function remove_element_for_region($element_id, $region_id)
  {
    if(ElementRegion::where(['element_id' => $element_id])->count() > 1)
    {
      return ElementRegion::where([
        'element_id' => $element_id,
        'region_id' => $region_id
      ])->delete();
    }
    return false;
  }
}
