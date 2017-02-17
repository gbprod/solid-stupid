<?php

namespace AppBundle\Post\Event;

use AppBundle\Post\Post;
use Symfony\Component\EventDispatcher\Event;

class PostWasCreated extends Event
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getPost()
    {
        return $this->post;
    }
}
