<?php

namespace AppBundle\Notifier;

use AppBundle\Post\Post;

interface Notifier
{
    public function notify(Post $post, array $usernames);
}
