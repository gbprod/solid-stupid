<?php

namespace AppBundle\Controller;

use AppBundle\Post\PostRepository;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;

class PostIndexController
{
    private $repository;

    private $twig;

    public function __construct(PostRepository $repository, EngineInterface $twig)
    {
        $this->repository = $repository;
        $this->twig       = $twig;
    }

    public function index()
    {
        $posts = $this->repository->all();

        return $this->twig->renderResponse('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }
}
