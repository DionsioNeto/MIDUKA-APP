<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use App\Models\Comment;
use Livewire\Attributes\Lazy;

#[lazy]

class KeyBoard extends Component{




    use WithPagination;

    public $newPost = '';
    public $comments = [];

    protected $rules = [
        'newPost' => 'required|string|max:500',
        'comments.*' => 'nullable|string|max:300',
    ];

    public function createPost()
    {
        $this->validateOnly('newPost');

        Post::create(['content' => $this->newPost]);
        $this->newPost = '';
        $this->resetPage();
    }

    public function addComment($postId)
    {
        $this->validateOnly("comments.$postId");

        if (!empty($this->comments[$postId])) {
            Comment::create([
                'post_id' => $postId,
                'content' => $this->comments[$postId]
            ]);

            $this->comments[$postId] = '';
        }
    }



    public function render(){
        return view('livewire.key-board');
    }
}
