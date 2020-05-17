<?php


namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    public $timestamps = false;
    protected $fillable = ['email', 'token', 'created_at'];

    protected $appends = ['expired'];

    public function getExpiredAttribute()
    {
        $diff = Carbon::now()->diffInSeconds(Carbon::parse($this->created_at));
        return $diff > 60 * 60; // token alive for 1 hour
    }

}