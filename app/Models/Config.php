<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Config extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = ['config_name','config_value'];
    protected $fillable = ['author', 'status'];
}
