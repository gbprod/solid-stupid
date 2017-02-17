<?php

namespace AppBundle\Post\Listener;

use AppBundle\Notifier\Notifier;
use AppBundle\Notifier\UsernameFinder;
use AppBundle\Post\Event\PostWasCreated;
use AppBundle\Post\Event\PostWasUpdated;
use AppBundle\Post\Post;

class NotifyPostListener
{
    private $notifier;

    private $usernameFinder;

    public function __construct(Notifier $notifier, UsernameFinder $usernameFinder)
    {
        $this->notifier = $notifier;
        $this->usernameFinder = $usernameFinder;
    }

    public function onNewPost(PostWasCreated $event)
    {
        $this->notify($event->getPost());
    }

    public function onUpdatedPost(PostWasUpdated $event)
    {
        $this->notify($event->getPost());
    }

    private function notify(Post $post)
    {
        $usernames = $this->usernameFinder->find($post->getMessage());

        $this->notifier->notify($post, $usernames);
    }
}
