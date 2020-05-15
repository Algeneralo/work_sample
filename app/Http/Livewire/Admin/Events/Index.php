<?php

namespace App\Http\Livewire\Admin\Events;

use App\Http\Traits\HasFiltersWithPagination;
use App\Http\Traits\WithPagination;
use App\Http\Traits\Sortable;
use App\Models\Category;
use App\Models\Event;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    use WithPagination, Sortable, HasFiltersWithPagination;

    public $lastMonth = 3;
    public $category = "";
    public $search = '';
    public $categories = [];
    protected $filters = ["lastMonth", "category_id"];
    protected $listeners = ['deleteItem' => 'delete'];

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function delete($id)
    {
        $status = Event::query()->findOrFail($id)->delete();
        if ($status)
            session()->flash("success", trans("messages.success.deleted"));
    }

    public function render()
    {
        return view('livewire.admin.events.index',
            [
                "events" => Event::search($this->search)
                    ->where("created_at", ">=", Carbon::now()->subMonths($this->lastMonth))
                    ->when($this->category != "" && $this->category != "all", function ($query) {
                        $query->where("category_id", $this->category);
                    })
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->select(["id", "name", "date", "start_time", "end_time", "category_id"])
                    ->with("category")
                    ->paginate($this->perPage),
            ]
        );
    }
}
