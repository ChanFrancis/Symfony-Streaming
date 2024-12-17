<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    public function __construct()
    {
    }

    #[Route(path: '/', name: 'page_homepage')]
    public function home(SessionInterface $session): Response
    {
        $session->set('test', 'value');

        $sessionValue = $session->get('test');

        return $this->render('index.html.twig', [
            'session_value' => $sessionValue,
        ]);
    }
}
