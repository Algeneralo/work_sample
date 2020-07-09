<?php

namespace App\Models;

use Illuminate\Database\Concerns\BuildsQueries;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Forum extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    const POST_TYPES_ADMINS = "admins";
    const POST_TYPES_ALL_USERS = "all_users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'designation',
        'details',
        'posts_type',
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

    public function alumnus()
    {
        return $this->belongsTo(\App\Models\Alumnus::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function comments()
    {
        return $this->hasManyThrough(Comment::class, Topic::class);
    }

    public static function search($string)
    {
        return empty($string) ? static::query()
            : static::where(function ($query) use ($string) {
                $query->where('designation', 'like', '%' . $string . '%');
            });
    }

    /**
     *  Sort query depend on giving data
     *
     * @param Builder $query
     * @param $field
     * @param $dir
     * @return BuildsQueries|Builder|mixed
     */
    public function scopeSortBy(Builder $query, $field, $dir)
    {
        return $query->when($field == "topics", function (Builder $query) use ($dir) {
            $query->orderBy("topics_count", $dir);
        })->when($field == "comments", function (Builder $query) use ($dir) {
            $query->orderBy("comments_count", $dir);
        })->when($field != "topics" && $field != "comments", function (Builder $query) use ($field, $dir) {
            $query->orderBy($field, $dir);
        });
    }

    public function getCoverAttribute()
    {
        return optional($this->getFirstMedia("cover"))->getFullUrl() ?? placeholder_image();
    }
}