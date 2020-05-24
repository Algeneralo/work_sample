<?php

namespace App\Http\Livewire\Admin\Media\Podcast;

use App\Http\Traits\HasFiltersWithPagination;
use App\Http\Traits\Sortable;
use App\Http\Traits\WithPagination;
use App\Models\Gallery;
use App\Models\Podcast;
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
        $status = Podcast::query()->findOrFail($id)->delete();
        if ($status)
            session()->flash("success", trans("messages.success.deleted"));
    }

    public function render()
    {
        return view('livewire.admin.media.podcast.index',
            [
                "media" => Podcast::search($this->search)
                    ->where("created_at", ">=", Carbon::now()->subMonths($this->lastMonth))
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->select(["id", "title", "created_at"])
                    ->paginate($this->perPage),
            ]);
    }

}
