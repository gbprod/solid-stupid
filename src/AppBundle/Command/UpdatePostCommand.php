<?php

namespace AppBundle\Command;

use AppBundle\Post\Post;
use Symfony\Component\Validator\Constraints as Assert;

final class UpdatePostCommand
{
    /**
     * @Assert\NotBlank()
     */
    public $id;

    /**
     * @Assert\NotBlank()
     */
    public $message;

    public static function from(Post $post)
    {
        $command = new self();

        $command->id = $post->getId();
        $command->message = $post->getMessage();

        return $command;
    }
}
