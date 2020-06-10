<?php

namespace App\Models;

use App\Http\Traits\CanLike;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class ApiAuth extends Authenticatable implements HasMedia
{
    use SoftDeletes, HasMediaTrait, HasApiTokens, CanLike;

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
        'university_id',
        'degree_program_id',
        'alumni_year',
        'description',
        'telephone',
        'mobile',
        "activation_code",
        'is_team_member',
        'blocked',
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
        "dob" => "date"
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ["name", "avatar"];
    protected $hidden = ["password"];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function degreeProgram()
    {
        return $this->belongsTo(DegreeProgram::class);
    }

    //Accessors
    public function getNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function getAvatarAttribute()
    {
        return Media::query()
            ->where(function ($query) {
                $query->where("model_type", "App\Models\Alumnus")
                    ->orWhere("model_type", "App\Models\Team")
                    ->orWhere("model_type", "App\Models\ApiAuth");
            })->where("model_id", $this->id)
            ->first()
            ->getFullUrl();
    }

    //Mutators
    public function setPasswordAttribute($value)
    {
        if ($value)
            $this->attributes["password"] = bcrypt($value);
    }
}
