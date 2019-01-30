<?php

namespace App\Models;

use Validator;
use Illuminate\Database\Eloquent\Model;

class Definition extends Model
{
  protected $fillable = ['element_id', 'definition'];

  const RULES = [
    'element_id' => 'required',
    'definition' => 'required',
  ];
  const MESSAGES = [
    'required' => "Es obligarorio"
  ];

  public static function store_definition($definition_data)
  {
    $validatedData = Validator::make(
      $definition_data, self::RULES, self::MESSAGES
    );

    if ($validatedData->fails()){
      return $validatedData;
    }else{
      Definition::create($definition_data);
    }
  }
}
