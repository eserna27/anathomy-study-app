<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
  public static function list_regions()
  {
    return Region::all();
  }
}
