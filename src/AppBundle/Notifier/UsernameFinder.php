<?php

namespace AppBundle\Notifier;

interface UsernameFinder
{
    public function find($message);
}
