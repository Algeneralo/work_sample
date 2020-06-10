<?php

namespace App\Http\Livewire\Admin\Forum;

use App\Http\Traits\WithPagination;
use App\Models\Alumnus;
use App\Models\Comment;
use App\Models\Comment as CommentModel;
use App\Models\Forum;
use App\Models\Topic as TopicModel;
use Livewire\Component;

class Topic extends Component
{
    use WithPagination;

    public $search = '';
    protected $listeners = [
        'deleteItem' => 'delete',
        'deleteComment' => 'deleteComment',
    ];

    /**
     * @var Forum
     */
    protected $forum;

    public function mount(Forum $forum)
    {
        $this->forum = $forum;
    }

    public function delete($id)
    {
        $status = TopicModel::query()->findOrFail($id)->delete();
        if ($status)
            session()->flash("success", trans("messages.success.deleted"));
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

    public function deleteComment($id)
    {
        $status = CommentModel::query()->findOrFail($id)->delete();
        if ($status)
            session()->flash("success", trans("messages.success.deleted"));
    }

    public function render()
    {
        return view('livewire.admin.forum.topic', [
            "topics" => TopicModel::search($this->search)
                ->with("comments", "comments.alumnus")
                ->orderByDesc("created_at")
                ->paginate(5)
        ]);
    }
}
