<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Offer extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'alumni_id',
        'type',
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

    protected $appends = ["images"];

    public function alumnus()
    {
        return $this->belongsTo(Alumnus::class, "alumni_id");
    }

    public static function search($string)
    {
        return empty($string) ? static::query()
            : static::query()->where(function ($query) use ($string) {
                $query->where('title', 'like', '%' . $string . '%');
            })->orWhereHas("alumnus", function ($query) use ($string) {
                $query->where('first_name', 'like', '%' . $string . '%')
                    ->orWhere('last_name', 'like', '%' . $string . '%');
            });
    }

    public function getImagesAttribute()
    {
        return $this->getMedia("images")->map(function (Media $media) {
            return [
                "id" => $media->id,
                "name" => $media->file_name,
                "link" => $media->getFullUrl(),
            ];
        });
    }
}
