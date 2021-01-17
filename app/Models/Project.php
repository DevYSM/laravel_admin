<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Project extends Model implements HasMedia, TranslatableContract
{
    use Translatable,HasMediaTrait;

    public $translatedAttributes = ['title', 'body'];
    protected $fillable = ['author', 'status'];

    /**
     * Register Media Collection
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('project')
            ->acceptsMimeTypes([
                'image/jpeg',
                'image/png',
                'image/jpg'
            ]);
    }

    /**
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */

    public function createMedia()
    {
        $name = md5(Str::random(50));
        $this->addMediaFromRequest('photo')
            ->preservingOriginal()
            ->usingName($name . '.png')
            ->usingFileName($name . '.png')
            ->toMediaCollection('project');
    }

    /**
     * @return string
     */
    public function photo()
    {
        return $this->getFirstMediaUrl('project');
    }
}
