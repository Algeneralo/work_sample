<?php

namespace App\Http\Livewire\Admin\Events;

use App\Http\Traits\HasFiltersWithPagination;
use App\Http\Traits\WithPagination;
use App\Http\Traits\Sortable;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    use WithPagination, Sortable, HasFiltersWithPagination;

    public $lastMonth = 3;
    public $search = '';
    public $category = "";
    protected $filters = ["lastMonth", "category"];
    protected $listeners = ['deleteItem' => 'delete'];


    public function delete($id)
    {

    }

    public function render()
    {
        return view('livewire.admin.events.index',
            [
                "events" => \App\User::search($this->search)
                    ->where("created_at", ">=", Carbon::now()->subMonths($this->lastMonth))
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage),
            ]
        );
    }
}
