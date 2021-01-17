<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigTranslation extends Model
{
    protected $fillable = ['config_name','config_value'];
}
