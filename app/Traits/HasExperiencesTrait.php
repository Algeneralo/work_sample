<?php


namespace App\Traits;


use App\Models\Experience;

trait HasExperiencesTrait
{
    public function experiences()
    {
        return $this->hasMany(Experience::class, "alumnus_id");
    }

    public function educationExperiences()
    {
        return $this->experiences->where("type", Experience::EDUCATION_EXPERIENCE);
    }

    public function workExperiences()
    {
        return $this->experiences->where("type", Experience::WORK_EXPERIENCE);
    }

    public function voluntaryExperiences()
    {
        return $this->experiences->where("type", Experience::VOLUNTARY_EXPERIENCE);
    }

    public function apprenticeshipExperiences()
    {
        return $this->experiences->where("type", Experience::APPRENTICESHIP_EXPERIENCE);
    }
}