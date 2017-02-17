<?php

namespace AppBundle\Post;

use Assert\Assertion;
use Doctrine\ORM\Mapping as ORM;

final class Post
{
    private $id;

    private $message;

    private $dateCreate;

    public function __construct($message, \DateTime $dateCreate = null)
    {
        $dateCreate = $dateCreate ?: new \DateTime();

        Assertion::string($message);
        Assertion::notBlank($message);
        Assertion::nullOrLessOrEqualThan($dateCreate, new \DateTime());

        $this->message = $message;
        $this->dateCreate = $dateCreate;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getDateCreate()
    {
        return $this->dateCreate;
    }

    public function updateMessage($message)
    {
        Assertion::string($message);
        Assertion::notBlank($message);

        $this->message = $message;
    }
}

