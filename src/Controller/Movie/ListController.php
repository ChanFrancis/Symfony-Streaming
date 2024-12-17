<?php

declare(strict_types=1);

namespace App\Controller\Movie;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListController extends AbstractController
{
    #[Route('/lists', name: 'page_lists')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->render('index.html.twig'); 
        }
        return $this->render('movie/lists.html.twig');
    }
}
