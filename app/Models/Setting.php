<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Setting extends Model implements TranslatableContract
{
    use HasFactory, Translatable;
    public $translatedAttributes = ['title', 'slogan', 'summary', 'address'];

    const IMAGE_DIRECTORY = '/app';
    protected $guarded = [];

    protected $appends = ['logo_url', 'logo_light_url'];
    protected function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return Storage::disk('s3')->temporaryUrl(
                $this->logo,
                now()->addDays(6)
            );
        }
        return null;
    }
    protected function getLogoLightUrlAttribute()
    {

        if ($this->logo_light) {
            return Storage::disk('s3')->temporaryUrl(
                $this->logo_light,
                now()->addDays(6)
            );
        }
        return null;
    }

    protected function  emails(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => explode(',', $value),
        );
    }



    protected function  phoneNumbers(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => explode(',', $value),
        );
    }
}
