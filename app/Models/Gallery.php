<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Gallery extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'details',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    protected $appends = ["cover"];

    public function linkedFriends()
    {
        return $this->belongsToMany(Alumnus::class, 'gallery_linked_friends', null, "alumni_id");
    }

    public static function search($string)
    {
        return empty($string) ? static::query()
            : static::where(function ($query) use ($string) {
                $query->where('title', 'like', '%' . $string . '%');
            });

    }

    public function getCoverAttribute()
    {
        return optional($this->getFirstMedia("cover"))->getFullUrl();
    }

    public function getCoverTypeAttribute()
    {
        return optional($this->getFirstMedia("cover"))->getTypeAttribute();
    }
}
