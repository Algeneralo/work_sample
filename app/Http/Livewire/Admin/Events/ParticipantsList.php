<?php

namespace App\Http\Livewire\Admin\Events;

use App\Models\Alumnus;
use App\User;
use Illuminate\Support\Collection;
use Livewire\Component;

class ParticipantsList extends Component
{
    public $search = '';
    public $open = false;
    public $isEdit;
    public $selectedParticipants = [];

    public function mount($selectedParticipants = [], $isEdit = false)
    {
        $selectedParticipants = is_array($selectedParticipants) ? collect($selectedParticipants) : $selectedParticipants;
        $this->isEdit = $isEdit;
        $selectedParticipants->each(function ($participant) {
            $this->selectedParticipants["$participant->id"] = $participant;
        });
    }

    public function updatedSearch()
    {
        $this->search != '' ? $this->open = true : '';
    }

    public function select($participantId)
    {
        $participant = Alumnus::findOrFail($participantId);
        $this->selectedParticipants["$participant->id"] = $participant;
        $this->search = '';
        $this->open = false;
    }

    public function unSelect($participantId)
    {
        unset($this->selectedParticipants[$participantId]);
    }

    public function render()
    {
        debug($this->selectedParticipants);
        return view('livewire.admin.events.participants-list',
            ["participants" => Alumnus::search($this->search)
                ->whereNotIn("id", array_keys($this->selectedParticipants))
                ->orderBy("first_name")
                ->orderBy("last_name")
                ->paginate(5)
            ]);
    }
}
