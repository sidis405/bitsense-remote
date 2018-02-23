<?php

namespace Bitsense\Blog\Models;

class Post
{
    private $title;
    private $body;
    private $author;

    public function __construct($title, $body, Author $author)
    {
        $this->title = $title;
        $this->body = $body;
        $this->author = $author;
    }



    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
