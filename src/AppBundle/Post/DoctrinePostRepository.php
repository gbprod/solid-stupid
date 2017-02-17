<?php

namespace AppBundle\Post;

use Doctrine\Common\Persistence\ObjectManager;

class DoctrinePostRepository implements PostRepository
{
    private $om;

    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    public function all()
    {
        return $this->om
            ->getRepository('AppBundle\Post\Post')
            ->findAll();
    }

    public function save($post)
    {
        $this->om->persist($post);
        $this->om->flush();
    }

    public function find($id)
    {
        return $this->om
            ->getRepository('AppBundle\Post\Post')
            ->find($id);
    }
}
