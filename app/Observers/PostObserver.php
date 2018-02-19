<?php

namespace App\Observers;

use App\Post;
use App\Events\PostWasCreated;
use App\Events\PostWasUpdated;

class PostObserver
{
    public function created(Post $post)
    {
        event(new PostWasCreated($post));
    }

    public function saved(Post $post)
    {
        event(new PostWasUpdated($post));
    }
}
