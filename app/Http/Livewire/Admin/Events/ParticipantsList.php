<?php

namespace App\Http\Livewire\Admin\Events;

use App\User;
use Illuminate\Support\Collection;
use Livewire\Component;

class ParticipantsList extends Component
{
    public $search = '';
    public $open = false;
    public $isEdit;
    public $selectedParticipants;

    public function mount($selectedParticipants = [], $isEdit = false)
    {
        $this->isEdit = $isEdit;
        $this->selectedParticipants = is_array($selectedParticipants) ? $selectedParticipants : $selectedParticipants->toArray();
    }

    public function updatedSearch()
    {
        $this->search != '' ? $this->open = true : $this->open = false;
    }

    public function select($participantId)
    {
        $participant = User::findOrFail($participantId);
        $this->selectedParticipants["$participant->id"] = $participant;
        $this->search = '';
    }

    public function unSelect($participantId)
    {
        unset($this->selectedParticipants[$participantId]);
    }

    public function render()
    {
        
        return view('livewire.admin.events.participants-list',
            ["participants" => User::search($this->search)
                ->whereNotIn("id", array_keys($this->selectedParticipants))
                ->paginate(5)
            ]);
    }
}
