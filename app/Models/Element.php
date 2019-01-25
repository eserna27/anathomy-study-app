<?php

namespace App\Models;

use Validator;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use App\Models\Region;

class Element extends Model
{
  use NodeTrait;
  protected $fillable = ['name', 'kind', 'region_id', 'system_id'];

  const RULES = [
    'name' => 'required|unique:elements',
    'kind' => 'required',
    'region_id' => 'required',
    'system_id' => 'required',
  ];
  const MESSAGES = [
    'required' => "Es obligarorio",
    'unique' => "No se puede repetir"
  ];


  public function region()
  {
      return $this->belongsTo(Region::class);
  }

  public static function store_element($element_data)
  {
    $validatedData = Validator::make(
      $element_data, self::RULES, self::MESSAGES
    );

    if ($validatedData->fails()){
      return $validatedData;
    }else{
      Element::create($element_data);
    }
  }
}
