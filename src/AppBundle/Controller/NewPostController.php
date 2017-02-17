<?php

namespace AppBundle\Controller;

use AppBundle\Command\NewPostCommand;
use AppBundle\Form\NewPostCommandType;
use AppBundle\Handler\NewPostHandler;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class NewPostController
{
    private $handler;

    private $formFactory;

    private $templating;

    private $urlGenerator;

    public function __construct(
        NewPostHandler $handler,
        FormFactory $formFactory,
        EngineInterface $templating,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->handler = $handler;
        $this->formFactory = $formFactory;
        $this->templating = $templating;
        $this->urlGenerator = $urlGenerator;
    }

    public function create(Request $request)
    {
        $command = new NewPostCommand();

        $form = $this->formFactory->create(NewPostCommandType::class, $command);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $this->handler->handle($form->getData());

            $url = $this->urlGenerator->generate('post_show', ['id' => $post->getId()]);

            return new RedirectResponse($url);
        }

        return $this->templating->renderResponse('post/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
