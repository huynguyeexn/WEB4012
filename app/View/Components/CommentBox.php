<?php

namespace App\View\Components;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\View\Component;

class CommentBox extends Component
{
    public $comments;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Post $posts, $id)
    {
        //
        $this->comments = $posts->find($id)->comments;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.site.comment-box');
    }
}
