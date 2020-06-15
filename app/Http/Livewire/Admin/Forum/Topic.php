<?php

namespace App\Http\Livewire\Admin\Forum;

use App\Http\Traits\WithPagination;
use App\Models\Alumnus;
use App\Models\Comment;
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
    public $forum;

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

    public function blockAlumnus($id, $topicId)
    {
        session()->put("lastTopic", $topicId);
        $alumnus = Alumnus::query()
            ->withoutGlobalScopes()
            ->findOrFail($id);

        $status = $alumnus->update(["blocked" => $alumnus->blocked ^= 1]);
        if ($status)
            session()->flash("success", trans("messages.success.deleted"));
    }

    public function deleteComment($id)
    {
        /** @var Comment $comment */
        $comment = Comment::query()->findOrFail($id);
        session()->put("lastTopic", $comment->topic->id);

        $status = $comment->delete();
        if ($status)
            session()->flash("success", trans("messages.success.deleted"));
    }

    public function render()
    {
        debug($this->forum['id']);
        return view('livewire.admin.forum.topic', [
            "topics" => TopicModel::search($this->search)
                ->where("forum_id", $this->forum['id'])
                ->with("comments", "comments.alumnus")
                ->orderByDesc("created_at")
                ->paginate(5)
        ]);
    }
}
