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
    $saved = false;
    $validatedData = Validator::make(
      $definition_data, self::RULES, self::MESSAGES
    );

    if ($validatedData->passes()){
      Definition::create($definition_data);
      $saved = true;
    }
    $data_response = [
      'saved' => $saved,
      'validator' => $validatedData
    ];
    return $data_response;
  }
}
