<?php

namespace AppBundle\Notifier;

use AppBundle\Post\Post;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class EmailNotifier implements Notifier
{
    private $mailer;

    private $templating;

    private $template;

    public function __construct(
        \Swift_Mailer $mailer,
        EngineInterface $templating,
        $template = 'emails/notification.html.twig'
    ) {
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->template = $template;
    }

    public function notify(Post $post, array $usernames)
    {
        foreach ($usernames as $username) {
            $message = $this->createMessage($post, $username);

            $this->mailer->send($message);
        }
    }

    private function createMessage(Post $post, $username)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('New message !')
            ->setFrom('postit@example.com')
            ->setTo($username . '@example.com')
            ->setBody(
                $this->templating->render($this->template, ['post' => $post]),
                'text/html'
            );

        return $message;
    }
}
