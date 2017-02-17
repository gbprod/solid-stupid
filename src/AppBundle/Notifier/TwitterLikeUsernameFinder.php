<?php

namespace AppBundle\Notifier;

class TwitterLikeUsernameFinder implements UsernameFinder
{
    public function find($message)
    {
        $usernames = [];
        if (preg_match_all('!@(.+)(?:\s|$)!U', $message, $matches)) {
            $usernames = $matches[1];
        }

        return $usernames;
    }
}
