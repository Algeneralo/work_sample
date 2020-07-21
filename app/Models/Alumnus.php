<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\HasExperiencesTrait;
use Cmgmyr\Messenger\Traits\Messagable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Alumnus extends Authenticatable implements HasMedia

{
    use SoftDeletes, HasMediaTrait, HasApiTokens, Messagable, HasExperiencesTrait;

    static $IS_TEAM_MEMBER = 0;
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

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($alumni) {
            //remove linked galleries when deleting alumni
            /** @var self $alumni */
            $alumni->linkedGalleries()->detach();
            $alumni->offers()->delete();
        });
    }

    public static function booted()
    {
        static::addGlobalScope('is_team_member', function (Builder $builder) {
            $builder->where('is_team_member', self::$IS_TEAM_MEMBER);
        });
    }

    public function category()
    {
        $this->hasOne(Category::class);
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function degreeProgram()
    {
        return $this->belongsTo(DegreeProgram::class);
    }

    public function participatedEvents()
    {
        return $this->belongsToMany(Event::class, "event_participants")
            ->where("date", '<=', Carbon::now());
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, "alumni_id");
    }

    public function linkedGalleries()
    {
        return $this->belongsToMany(Gallery::class, "gallery_linked_friends", "alumni_id");
    }

    public static function search($string)
    {
        return empty($string) ? static::query()
            : static::where(function ($query) use ($string) {
                $query->where('first_name', 'like', '%' . $string . '%')
                    ->orWhere('last_name', 'like', '%' . $string . '%')
                    ->orWhere('email', 'like', '%' . $string . '%');
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
                ->getFullUrl() ?? avatar_placeholder_image();
    }

    //Mutators
    public function setPasswordAttribute($value)
    {
        if ($value)
            $this->attributes["password"] = bcrypt($value);
    }
}
