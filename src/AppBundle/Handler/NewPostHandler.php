<?php

namespace AppBundle\Handler;

use AppBundle\Command\NewPostCommand;
use AppBundle\Post\Post;
use AppBundle\Post\Event\PostWasCreated;
use AppBundle\Post\PostRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class NewPostHandler
{
    private $repository;

    private $dispatcher;

    public function __construct(PostRepository $repository, EventDispatcherInterface $dispatcher)
    {
        $this->repository = $repository;
        $this->dispatcher = $dispatcher;
    }

    public function handle(NewPostCommand $command)
    {
        $post = new Post($command->message);

        $this->repository->save($post);

        $this->dispatcher->dispatch(PostWasCreated::class, new PostWasCreated($post));

        return $post;
    }
}
