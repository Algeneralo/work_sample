<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventReviews extends Model
{
    protected $fillable = ["rate", "title", "details", "alumni_id", "event_id"];

    public function alumnus()
    {
        return $this->belongsTo(Alumnus::class, 'alumni_id');
    }
}
