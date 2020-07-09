<?php

namespace App\Models;

use App\Duration;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Podcast extends Model implements HasMedia
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
    protected $appends = ["cover", "voice"];

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

    public function getVoiceAttribute()
    {
        return optional($this->getFirstMedia("podcast"))->getFullUrl();
    }


    public function getDurationAttribute()
    {
        $media = $this->getFirstMedia("podcast");
        $duration = FFMpeg::fromDisk("public")->open(str_replace("/storage/", "", $media->getUrl()))->getDurationInSeconds();
        return (new Duration($duration))->humanize();
    }
}
