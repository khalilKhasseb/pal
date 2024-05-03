<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\On;

class CommentList extends Component
{
    public Post $post;
    public function render()
    {
        return view('livewire.comment-list');
    }

    #[On('comment-created')]
    public function re_render()
    {
        $this->render();
    }
}
