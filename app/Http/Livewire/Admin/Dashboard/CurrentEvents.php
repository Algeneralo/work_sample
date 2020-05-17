<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Event;
use Carbon\Carbon;
use Livewire\Component;

class CurrentEvents extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard.current-events',
            ["events" => Event::query()
                ->orderBy("created_at")
                ->whereDate("date", ">=", Carbon::now())
                ->take(5)
                ->get()]
        );
    }
}
