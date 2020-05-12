<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\User;
use Livewire\Component;
use App\Http\Traits\WithPagination;

class CurrentEvents extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.admin.dashboard.current-events',
            ["events" => User::query()->paginate(4)]
        );
    }
}
