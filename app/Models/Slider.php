<?php

namespace App\Models;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * App\Models\Slider
 *
 * @property int $id
 * @property string $photo
 * @property string $title_en
 * @property string $body_en
 * @property string|null $title_ar
 * @property string|null $body_ar
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider query()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereBodyAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereBodyEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereTitleAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Slider extends Model implements TranslatableContract, HasMedia
{
    use Translatable, HasMediaTrait;
    public $translatedAttributes = ['body'];
    protected $fillable = ['author','status'];

    /**
     * Register Media Collection
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('slider')
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
            ->toMediaCollection('slider');
    }

    /**
     * @return string
     */
    public function photo()
    {
        return $this->getFirstMediaUrl('slider');
    }
}
