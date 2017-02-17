<?php

namespace AppBundle\Controller;

use AppBundle\Command\UpdatePostCommand;
use AppBundle\Form\UpdatePostCommandType;
use AppBundle\Handler\UpdatePostHandler;
use AppBundle\Post\PostRepository;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class UpdatePostController
{
    private $handler;

    private $formFactory;

    private $templating;

    private $urlGenerator;

    private $repository;

    public function __construct(
        UpdatePostHandler $handler,
        FormFactory $formFactory,
        EngineInterface $templating,
        UrlGeneratorInterface $urlGenerator,
        PostRepository $repository
    ) {
        $this->handler = $handler;
        $this->formFactory = $formFactory;
        $this->templating = $templating;
        $this->urlGenerator = $urlGenerator;
        $this->repository = $repository;
    }

    public function update(Request $request, $id)
    {
        $post = $this->repository->find($id);
        $command = UpdatePostCommand::from($post);

        $editForm = $this->formFactory->create(UpdatePostCommandType::class, $command);

        if ($this->isFormValid($request, $editForm)) {
            $this->handler->handle($command);

            return new RedirectResponse(
                $this->urlGenerator->generate('post_edit', ['id' => $id])
            );
        }

        return $this->templating->renderResponse('post/edit.html.twig', array(
            'post' => $post,
            'edit_form' => $editForm->createView(),
        ));
    }

    private function isFormValid(Request $request, FormInterface $editForm)
    {
        $editForm->handleRequest($request);

        return $editForm->isSubmitted() && $editForm->isValid();
    }
}
