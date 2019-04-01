<?php

namespace App\Models;

use Validator;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use App\Models\Region;
use App\Models\System;
use App\Models\Definition;

class Element extends Model
{
  use NodeTrait;
  protected $fillable = ['name', 'kind', 'system_id'];

  const RULES = [
    'name' => 'required|unique:elements',
    'kind' => 'required',
    'system_id' => 'required',
    'region_id' => 'required',
  ];
  const MESSAGES = [
    'required' => "Es obligarorio",
    'unique' => "No se puede repetir"
  ];

  public function regions()
  {
    return $this->belongsToMany(Region::class, 'element_regions', 'element_id', 'region_id');
  }

  public function system()
  {
    return $this->belongsTo(System::class);
  }

  public function definitions()
  {
    return $this->hasMany(Definition::class, 'element_id', 'id');
  }

  public function root_regions()
  {
    return $this->regions->map(function ($region, $key) {
        return $region->parent()->get();
    })->flatten();
  }

  public static function store_element($element_data)
  {
    $saved = false;
    $validatedData = Validator::make(
      $element_data, self::RULES, self::MESSAGES
    );

    if ($validatedData->passes()){
      $element = Element::create($element_data);
      Region::find($element_data['region_id'])->elements()->attach($element);
      $saved = true;
    }
    $data_response = [
      'saved' => $saved,
      'validator' => $validatedData
    ];
    return $data_response;
  }
}
