<?php

namespace Bitsense\Blog\Repositories;

use Bitsense\Blog\Eloquent\Repository;

class PostRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return \App\Post::class;
    }
}
