<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class JobMarketContact extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = ["name", "company_name", "telephone", "email"];

    public function getCoverAttribute()
    {
        return optional($this->getFirstMedia("avatar"))->getFullUrl();
    }
}
