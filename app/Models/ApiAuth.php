<?php

namespace App\Models;

use App\Http\Traits\CanLike;
use App\Traits\HasExperiencesTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\ResetApiPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class ApiAuth extends Authenticatable implements HasMedia
{
    use SoftDeletes, HasMediaTrait, HasApiTokens, CanLike, Notifiable, HasExperiencesTrait;

    protected $table = "alumni";

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
        'alumni_year',
        'description',
        'telephone',
        'mobile',
        "activation_code",
        'is_team_member',
        'blocked',
        'job_title',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'university_id' => 'integer',
        'degree_program_id' => 'integer',
        'is_team_member' => 'boolean',
        "dob" => "date",
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ["name", "avatar"];
    protected $hidden = ["password"];


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
                ->getFullUrl() ?? avatar_placeholder_image();
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    //Mutators
    public function setPasswordAttribute($value)
    {
        if ($value)
            $this->attributes["password"] = bcrypt($value);
    }

    public function participatedEvents()
    {
        return $this->belongsToMany(Event::class, "event_participants");
    }
}
