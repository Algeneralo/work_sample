<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Topic extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $fillable = [
        "title",
        "details",
        "forum_id",
    ];

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
}
