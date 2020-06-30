<?php

namespace App\Http\Livewire\Admin\Media\Story;

use Carbon\Carbon;
use App\Models\Story;
use Livewire\Component;
use App\Http\Traits\Sortable;
use App\Http\Traits\WithPagination;
use App\Http\Traits\HasFiltersWithPagination;

class Index extends Component
{
    use WithPagination, Sortable, HasFiltersWithPagination;

    public $lastMonth = 3;
    public $search = '';
    public $filters = ["lastMonth"];
    protected $listeners = ['deleteItem' => 'delete'];

    public function delete($id)
    {
        $status = Story::query()->findOrFail($id)->delete();
        if ($status)
            session()->flash("success", trans("messages.success.deleted"));
    }

    public function render()
    {
        return view('livewire.admin.media.story.index',
            [
                "stories" => Story::search($this->search)
                    ->where("created_at", ">=", Carbon::now()->subMonths($this->lastMonth))
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->select(["id", "title", "alumnus_id", "created_at"])
                    ->with("alumnus:id,first_name,last_name")
                    ->paginate($this->perPage),
            ]);
    }
}
