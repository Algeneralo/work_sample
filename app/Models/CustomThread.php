<?php

namespace App\Models;

use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\Model;

class CustomThread extends Thread
{
    /**
     * Get thread receiver
     * @return mixed
     */
    public function receiver()
    {
        return $this->participants()->where("user_id", "!=", auth()->id() ?? auth()->guard("alumni")->id())->first()->user()->withoutGlobalScopes()->first();
    }

    public function getLastUpdateAttribute()
    {
        return $this->updated_at->isToday() ? $this->updated_at->format("H:i") : $this->updated_at->format("D");
    }

    protected static function createThread($userID)
    {
        /** @var self $thread */
        $thread = self::query()->create([
            'subject' => "direct-conversation",
        ]);

        $thread->participants()->create([
            'thread_id' => $thread->id,
            'user_id' => auth()->id() ?? auth()->guard("alumni")->id(),
            'last_read' => new Carbon(),
        ]);
        $thread->addParticipant($userID);

        return $thread;
    }

    public static function getUserFirstThread($userID)
    {
        return \App\Models\CustomThread::forUser(auth()->id() ?? auth()->guard("alumni")->id())
            ->latest('updated_at')
            ->whereHas("users", function ($query) use ($userID) {
                $query->where("user_id", $userID);
            })->firstOr(function () use ($userID) {
                return self::createThread($userID);
            });
    }
}
