<?php

namespace AppBundle\Post\Event;

use AppBundle\Post\Post;
use Symfony\Component\EventDispatcher\Event;

class PostWasUpdated extends Event
{
    private $post;

    private $previousMessage;

    public function __construct(Post $post, $previousMessage)
    {
        $this->post = $post;
        $this->previousMessage = $previousMessage;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function getPreviousMessage()
    {
        return $this->previousMessage;
    }
}
