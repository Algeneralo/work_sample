<?php

namespace App\Http\Livewire\Admin\MyNetwork\Alumni;

use App\Http\Traits\HasFiltersWithPagination;
use App\Http\Traits\Sortable;
use App\Models\Alumnus;
use Carbon\Carbon;
use Livewire\Component;
use App\Http\Traits\WithPagination;

class Index extends Component
{
    use WithPagination, Sortable, HasFiltersWithPagination;

    public $lastMonth = 3;
    public $search = '';
    public $filters = ["lastMonth"];

    protected $listeners = ['deleteItem' => 'delete'];


    public function delete($id)
    {
        $status = Alumnus::query()->findOrFail($id)->delete();
        if ($status)
            session()->flash("success", trans("messages.success.deleted"));
    }


    public function render()
    {
        return view('livewire.admin.my-network.alumni.index',
            [
                "alumni" => Alumnus::search($this->search)
                    ->where("created_at", ">=", Carbon::now()->subMonths($this->lastMonth))
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage),
            ]
        );
    }
}
