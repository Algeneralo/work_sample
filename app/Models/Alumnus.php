<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Alumnus extends Model implements HasMedia

{
    use SoftDeletes, HasMediaTrait;

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
        'dob',
        'university_id',
        'degree_program_id',
        'alumni_year',
        'description',
        'telephone',
        'mobile',
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
        return $this->getFirstMediaUrl("avatar");
    }
    //Mutators
}
