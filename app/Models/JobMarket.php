<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class JobMarket extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employer',
        'offer',
        'category',
        'working_hours',
        "city",
        'beginning',
        'duration',
        'details',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'beginning' => 'date',
    ];
    protected $appends = ["cover", "working_hours_string"];

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

    public function getCoverAttribute()
    {
        return optional($this->getFirstMedia("cover"))->getFullUrl();
    }

    public function getWorkingHoursStringAttribute()
    {
        $string = '';
        switch ($this->working_hours) {
            case "part_time":
                $string = trans("general.part-time");
                break;
            case "full_time":
                $string = trans("general.full-time");
                break;
        }
        return $string;
    }
}
