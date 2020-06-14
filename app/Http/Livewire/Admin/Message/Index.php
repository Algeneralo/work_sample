<?php

namespace App\Http\Livewire\Admin\Message;

use App\Models\Alumnus;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Models;
use App\Models\CustomThread as Thread;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use phpDocumentor\Reflection\Types\Boolean;

class Index extends Component
{
    /**
     * @var string $search
     */
    public $search = '';

    /**
     * @var string $search
     */
    public $message = '';

    /**
     * @var Thread $threads
     */
    public $threads;

    /**
     * @var Thread $selectedThread
     */
    public $selectedThread;

    /**
     * @var Alumnus $alumni
     */
    public $alumni;
    /**
     * @var Boolean $isAutofocus
     */
    public $isAutofocus;

    protected $listeners = [ 'test' => 'test'];
    public function updatedMessage()
    {
        $this->isAutofocus = true;
    }

    private function getAlumni()
    {
        $this->alumni = Alumnus::search($this->search)
            ->orderBy("first_name")
            ->orderBy("last_name")
            ->take(7)
            ->get(["id", "first_name", "last_name"]);
    }

    /**
     * Ger direct conversation
     *
     * @param $userID
     */
    private function getThread($userID)
    {
        Models::setUserModel(Alumnus::class);
        $this->selectedThread = Thread::forUser(auth()->id())
            ->latest('updated_at')
            ->whereHas("users", function ($query) use ($userID) {
                $query->where("user_id", $userID);
            })->firstOr(function () use ($userID) {
                return Thread::createThread($userID);
            });
    }

    /**
     * Get selected thread/conversation messages
     *
     * @return Collection
     */
    private function getMessages()
    {
        return $this->selectedThread->messages()
            ->orderBy("created_at")
            ->get()
            ->groupBy(function ($message) {
                return $message->created_at->isToday()
                    ? trans("general.today")
                    : $message->created_at->format("d.m.Y");
            });
    }

    /**
     * Create Direct conversation for user and authenticated alumnus
     *
     * @param $userID
     * @return Thread
     */


    /**
     * Event that happen when selecting a conversation
     * @param $userID
     */
    public function select($userID)
    {
        $this->getThread($userID);
        $this->message = "";
    }

    public function sendMessage($userID)
    {
        $this->validate([
            "message" => 'required'
        ]);
        Message::create([
            'thread_id' => $this->selectedThread->id,
            'user_id' => auth()->id(),
            'body' => $this->message,
        ]);
        $this->message = "";
    }

    public function render()
    {
        Models::setUserModel(Alumnus::class);
        $this->getAlumni();
        $messages = $this->selectedThread ? $this->getMessages() : [];

        return view('livewire.admin.message.index', [
            "grouped" => $messages,
            "threads" => $this->threads,
            "selectedThread" => $this->selectedThread,
            "alumnus" => $this->alumni,
        ]);
    }

}
