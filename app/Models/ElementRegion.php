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
}
