<?php

namespace App\Http\Livewire\Admin\BulletinBoard\General;

use App\Http\Traits\HasFiltersWithPagination;
use App\Http\Traits\Sortable;
use App\Http\Traits\WithPagination;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    use WithPagination, Sortable, HasFiltersWithPagination;

    public $lastMonth = 3;
    public $search = '';
    public $filters = ["lastMonth"];

    protected $listeners = ['deleteItem' => 'delete'];


    public function delete($id)
    {
        debug("WORK 2");
    }

    public function render()
    {
        return view('livewire.admin.bulletin-board.general.index',
            [
                "general" => \App\User::search($this->search)
                    ->where("created_at", ">=", Carbon::now()->subMonths($this->lastMonth))
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage),
            ]
        );
    }
}
