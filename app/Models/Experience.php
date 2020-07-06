<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    const WORK_EXPERIENCE = "work";
    const EDUCATION_EXPERIENCE = "education";

    protected $fillable = ["alumnus_id", "place", "title", "period", "type"];
}
