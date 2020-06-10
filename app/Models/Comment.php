<?php

namespace App\Models;

use App\Http\Traits\CanBeLiked;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes, CanBeLiked;

    protected $table = "topic_comments";
    protected $fillable = ["comment", "alumnus_id", "topic_id"];

    public function alumnus()
    {
        return $this->belongsTo(Alumnus::class, 'alumnus_id')
            ->withoutGlobalScopes()
            ->withTrashed();
    }

    public static function search($string)
    {
        return empty($string) ? static::query()
            : static::where(function ($query) use ($string) {
                $query->where('comment', 'like', '%' . $string . '%');
            });
    }
}
