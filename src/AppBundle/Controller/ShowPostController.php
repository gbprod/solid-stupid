<?php

namespace AppBundle\Controller;

use AppBundle\Post\PostRepository;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ShowPostController
{
    private $repository;

    private $templating;

    public function __construct(PostRepository $repository, EngineInterface $templating)
    {
        $this->repository = $repository;
        $this->templating = $templating;
    }

    public function show($id)
    {
        $post = $this->repository->find($id);

        if (null === $post) {
            throw new NotFoundHttpException();
        }

        return $this->templating->renderResponse('post/show.html.twig', array(
            'post' => $post,
        ));
    }
}
