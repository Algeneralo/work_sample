<?php

namespace App\Http\Livewire\Admin\Experience;

use Livewire\Component;
use Illuminate\Support\Collection;

class Index extends Component
{
    public $place = "";
    public $title = "";
    public $period = "";
    public $experiences;

    public $type;

    public function mount($type, $experiences = [])
    {
        $this->type = $type;
        $this->experiences = $experiences;
        if ($this->experiences instanceof Collection)
            $this->experiences = $this->experiences->toArray();
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            "place" => "required",
            "title" => "required",
            "period" => "required",
        ]);
    }

    public function add()
    {
        $this->validate([
            "place" => "required",
            "title" => "required",
            "period" => "required",
        ]);
        $this->experiences[] = [
            "place" => $this->place,
            "title" => $this->title,
            "period" => $this->period,
        ];
        $this->reset("place", "title", "period");
    }

    public function remove($id)
    {
        unset($this->experiences[$id]);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('livewire.admin.experience.index');
    }
}