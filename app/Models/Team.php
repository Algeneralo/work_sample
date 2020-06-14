<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Team extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $table = "alumni";
    static $IS_TEAM_MEMBER = 1;

    protected $attributes = [
        'is_team_member' => 1,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'street',
        'street_number',
        'postcode',
        'city',
        'email',
        'password',
        'dob',
        'telephone',
        'mobile',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        "dob" => "date"
    ];
    protected $hidden = ["password"];

    public static function booted()
    {
        static::addGlobalScope('team_member', function (Builder $builder) {
            $builder->where('is_team_member', self::$IS_TEAM_MEMBER);
        });
    }


    //Accessors
    public function getNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function getAvatarAttribute()
    {
        return optional(Media::query()
            ->where(function ($query) {
                $query->where("model_type", "App\Models\Alumnus")
                    ->orWhere("model_type", "App\Models\Team")
                    ->orWhere("model_type", "App\Models\ApiAuth");
            })->where("model_id", $this->id)
            ->first())
            ->getFullUrl();
    }

    //Mutators
    public function setPasswordAttribute($value)
    {
        if ($value)
            $this->attributes["password"] = bcrypt($value);
    }
}
