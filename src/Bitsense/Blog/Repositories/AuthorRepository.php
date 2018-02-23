<?php

namespace Bitsense\Blog\Repositories;

use Bitsense\Blog\Eloquent\Repository;

class AuthorRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return \App\User::class;
    }
}
