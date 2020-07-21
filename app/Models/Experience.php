<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    const WORK_EXPERIENCE = "work";
    const EDUCATION_EXPERIENCE = "education";
    const VOLUNTARY_EXPERIENCE = "voluntary";
    const APPRENTICESHIP_EXPERIENCE = "apprenticeship";

    protected $fillable = ["alumnus_id", "place", "title", "period", "type"];
}
