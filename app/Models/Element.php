<?php

namespace App\Models;

use Validator;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use App\Models\Region;
use App\Models\System;
use App\Models\Definition;
use App\Models\ElementRegion;

class Element extends Model
{
  use NodeTrait;
  protected $fillable = ['name', 'kind', 'system_id', 'parent_id'];

  const MESSAGES = [
    'required' => "Es obligarorio",
    'unique' => "No se puede repetir"
  ];

  protected static $rules = [
    'name' => 'required|unique:elements',
    'kind' => 'required',
    'system_id' => 'required',
    'region_id' => 'required',
  ];

  public function regions()
  {
    return $this->belongsToMany(Region::class, 'element_regions', 'element_id', 'region_id');
  }

  public function can_remove_region()
  {
    return (ElementRegion::where(['element_id' => $this->id])->count() > 1);
  }

  public function element_with_descendants()
  {
    $descendants = Element::with('descendants')->findOrFail($this->id)->descendants->all();
    array_unshift($descendants, $this);
    return collect($descendants);
  }

  public static function kind_options()
  {
    return [
      'bone' => "Hueso",
      'muscle' => "Músculo",
      'nerve' => "Nervio",
      'artery' => "Arteria",
      'vein' => "Vena",
      'organ' => "Órgano"
    ];
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

  public function parts()
  {
    return $this->children;
  }

  public function parts_for_region($region_id)
  {
    return $this->parts()->map(function($part){
      return [
        'element' => $part,
        'regions' => $part->regions()->get()
      ];
    })->filter(function($part_with_regions) use ($region_id){
      return $part_with_regions['regions']->contains($region_id);
    })->map(function($part_with_regions){
      return $part_with_regions['element'];
    });
  }

  public function list_parts_for_region($region_id)
  {
    return $this->parts()->map(function($part){
      return [
        'element' => $part,
        'regions' => $part->regions()->get()
      ];
    })->filter(function($part_with_regions) use ($region_id){
      return $part_with_regions['regions']->contains($region_id);
    })->map(function($part_with_regions){
      return $part_with_regions['element'];
    });
  }

  public static function all_roots()
  {
    return Element::where(['parent_id' => null])->get();
  }

  public static function store_element($element_data)
  {
    $saved = false;
    $validatedData = Validator::make(
      $element_data, Element::$rules, self::MESSAGES
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

  public static function delete_element($element_id)
  {
    ElementRegion::where(['element_id' => $element_id])->delete();
    return Element::destroy($element_id);
  }

  public static function update_element($element_id, $element_data)
  {
    $updated = false;
    $rules = Element::$rules;
    $rules['name'] = $rules['name'] . ',id,' . $element_id;
    $rules['region_id'] = "";
    $rules['system_id'] = "";
    $validatedData = Validator::make(
      $element_data, $rules, self::MESSAGES
    );

    if ($validatedData->passes()){
      Element::find($element_id)->update($element_data);
      $updated = true;
    }
    $data_response = [
      'updated' => $updated,
      'validator' => $validatedData
    ];
    return $data_response;
  }
}
