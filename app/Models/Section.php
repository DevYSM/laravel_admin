<?php

namespace App\Models;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;

class Section extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = ['body'];
    protected $fillable = ['author', 'status'];
}
