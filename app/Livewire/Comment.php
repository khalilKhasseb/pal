<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Post;
use App\Models\Comment as CommentModel;

class Comment extends Component
{
    public string $comment = '';
    public string $name = '';
    public string $email = '';
    public string  $website = '';

    public Post $post;

    // public string $post_id ;

    public function mount(Post $post = null)
    {

        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.comment');
    }


    public function store()
    {
        $comment = CommentModel::create($this->all());

        $this->post->comments()->save($comment);

        $this->reset('name', 'email', 'comment', 'website');
        $this->dispatch('comment-created');
    }
}
