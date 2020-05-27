<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Alumnus extends Authenticatable implements HasMedia

{
    use SoftDeletes, HasMediaTrait, HasApiTokens;

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

    public static function booted()
    {
        //this is because of passport dose't support removing scope
        if ((request()->route()->getName() != 'api.login') && (request()->route()->getName() != 'api.refresh-token'))
            return;

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
        return optional($this->getFirstMedia("avatar"))->getFullUrl();
    }

    //Mutators
    public function setPasswordAttribute($value)
    {
        if ($value)
            $this->attributes["password"] = bcrypt($value);
    }
}
