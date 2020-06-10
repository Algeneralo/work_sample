<?php

namespace App\Http\Livewire\Admin\Forum;

use App\Models\Alumnus;
use App\Models\Comment as CommentModel;
use Livewire\Component;

class Comment extends Component
{
    protected $listeners = [
        'deleteComment' => 'delete',
    ];

    public $topicId;
    public $forumId;

    public function mount($topicId,$forumId)
    {
        $this->topicId = $topicId;
        $this->forumId = $forumId;
    }

    public function blockAlumnus($id)
    {
        $alumnus = Alumnus::query()
            ->withoutGlobalScopes()
            ->findOrFail($id);
        $status = $alumnus->update(["blocked" => $alumnus->blocked ^= 1]);
        if ($status)
            session()->flash("success", trans("messages.success.deleted"));
    }

    public function delete($id)
    {
        $status = CommentModel::query()->findOrFail($id)->delete();
        if ($status)
            session()->flash("success", trans("messages.success.deleted"));
    }


    public function render()
    {
        return view('livewire.admin.forum.comment', [
            "comments" => CommentModel::query()
                ->where("topic_id", $this->topicId)
                ->with("alumnus:id,first_name,last_name")
                ->get()
        ]);
    }
}
