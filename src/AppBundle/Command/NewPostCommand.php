<?php

namespace AppBundle\Command;

use Symfony\Component\Validator\Constraints as Assert;

final class NewPostCommand
{
    /**
     * @Assert\NotBlank()
     */
    public $message;
}
