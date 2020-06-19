<?php

namespace App\Http\Livewire\Admin\Message;

use App\Models\Alumnus;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Models;
use App\Models\CustomThread as Thread;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Index extends Component
{
    /**
     * @var string $search
     */
    public $search = '';

    /**
     * @var string $message
     */
    public $message = '';

    /**
     * @var string $messageToAll
     */
    public $messageToAll = '';


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
     * @var string
     */
    public $userID = "";

    protected $updatesQueryString = [
        'userID' => ['except' => ''],
    ];

    public function mount()
    {
        $this->fill(request()->only('userID'));
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
        $this->selectedThread = Thread::getUserFirstThread($userID);
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
            ->withoutGlobalScopes()
            ->get()
            ->groupBy(function ($message) {
                return $message->created_at->isToday()
                    ? trans("general.today")
                    : $message->created_at->format("d.m.Y");
            });
    }

    /**
     * Event that happen when selecting a conversation
     * @param $userID
     */
    public function select($userID)
    {
        $this->getThread($userID);
        $this->message = "";
    }

    /**
     * Send message on selected chat
     * @param string $text this field will be send if the event triggered from input
     * @param bool $eventFromButton determine if the event triggered from button or not
     */
    public function sendMessage($text = "", $eventFromButton = false)
    {
        $this->message = $eventFromButton ? $this->message : $text;
        $this->validate([
            "message" => 'required'
        ]);
        Message::create([
            'thread_id' => $this->selectedThread->id,
            'user_id' => auth()->guard("alumni")->id(),
            'body' => $this->message,
        ]);
        $this->message = "";
        //this event will focus again to text input
        $this->emit("inputFocus");
    }

    /**
     *  Send message to all alumni
     */
    public function sendMessageToAllAlumni()
    {
        Models::setUserModel(Alumnus::class);

        Alumnus::query()->get()->each(function ($alumnus) {
            $thread = Thread::getUserFirstThread($alumnus->id);
            Message::create([
                'thread_id' => $thread->id,
                'user_id' => auth()->guard("alumni")->id(),
                'body' => $this->messageToAll,
            ]);
        });
        session()->flash("success", trans("general.message-sent-successfully"));
        $this->messageToAll = "";
        $this->emit("closeModal");

    }

    public function render()
    {
        Models::setUserModel(Alumnus::class);
        $this->getAlumni();
        //check if there is a selected team member for sending message
        if ($this->userID) {
            $this->select($this->userID);
            $this->reset("userID");
        }
        $messages = $this->selectedThread ? $this->getMessages() : [];
        return view('livewire.admin.message.index', [
            "grouped" => $messages,
            "threads" => $this->threads,
            "selectedThread" => $this->selectedThread,
            "alumnus" => $this->alumni,
        ]);
    }

}
