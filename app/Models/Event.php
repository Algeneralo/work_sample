<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Event extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'street',
        'street_number',
        'postcode',
        'city',
        'details',
        'max_participants',
        'date',
        'start_time',
        'end_time',
        'category_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];
    protected $appends = ["from_to_time", "cover", "range_time", "color", "rate", "address"];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function participants()
    {
        return $this->belongsToMany(\App\Models\Alumnus::class, "event_participants");
    }

    public function reviews()
    {
        return $this->hasMany(EventReviews::class);
    }

    public static function search($string)
    {
        return empty($string) ? static::query()
            : static::where(function ($query) use ($string) {
                $query->where('name', 'like', '%' . $string . '%')
                    ->orWhere('date', 'like', '%' . $string . '%')
                    ->orWhere('start_time', 'like', '%' . $string . '%')
                    ->orWhere('end_time', 'like', '%' . $string . '%');
            });

    }

    public function getFromToTimeAttribute()
    {
        return $this->start_time->format("H:i") . " Uhr - " . $this->end_time->format("H:i") . " Uhr";
    }

    public function getRangeTimeAttribute()
    {
        return $this->start_time->format("H:i") . " ~ " . $this->end_time->format("H:i");
    }

    public function getCoverAttribute()
    {
        return optional($this->getFirstMedia("cover"))->getFullUrl();
    }

    public function getColorAttribute()
    {
        return string_to_color($this->name . "" . $this->id . $this->date);
    }

    public function getRateAttribute()
    {
        return $this->reviews()->avg("rate") ? round($this->reviews()->avg("rate")) : 0;
    }

    public function getAddressAttribute()
    {
        return $this->street . " " . $this->stree_number . "<br>" . $this->city . " " . $this->postcode;
    }
}
