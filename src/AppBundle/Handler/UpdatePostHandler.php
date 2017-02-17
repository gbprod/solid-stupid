<?php

namespace AppBundle\Handler;

use AppBundle\Command\UpdatePostCommand;
use AppBundle\Post\Event\PostWasUpdated;
use AppBundle\Post\PostRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class UpdatePostHandler
{
    private $repository;

    private $dispatcher;

    public function __construct(PostRepository $repository, EventDispatcherInterface $dispatcher)
    {
        $this->repository = $repository;
        $this->dispatcher = $dispatcher;
    }

    public function handle(UpdatePostCommand $command)
    {
        $post = $this->repository->find($command->id);
        $previousMessage = $post->getMessage();
        $post->updateMessage($command->message);
        $this->repository->save($post);

        $this->dispatcher->dispatch(PostWasUpdated::class, new PostWasUpdated($post, $previousMessage));

        return $post;
    }
}
