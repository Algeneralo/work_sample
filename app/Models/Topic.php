<?php

namespace App\Models;

use App\Http\Traits\CanBeLiked;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Topic extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait, CanBeLiked;

    protected $fillable = [
        "title",
        "details",
        "forum_id",
    ];
    protected $appends = ["cover"];

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderByDesc("created_at");
    }

    public function alumnus()
    {
        return $this->belongsTo(Alumnus::class);
    }

    public static function search($string)
    {
        return empty($string) ? static::query()
            : static::where(function ($query) use ($string) {
                $query->where('title', 'like', '%' . $string . '%');
            });
    }

    public function forum()
    {
        return $this->belongsTo(Forum::class);
}

    public function getCoverAttribute()
    {
        return optional($this->getFirstMedia("cover"))->getFullUrl();
    }
}
