<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
  public static function list_systems()
  {
    return System::all();
  }
}
