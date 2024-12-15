<?php

namespace App\Controller;

use App\Entity\AccessToken;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class ApiLoginController extends AbstractController
{
    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function index(
        #[CurrentUser] ?User $user,
        EntityManagerInterface $entityManager
    ): Response {
        if (null === $user) {
            return $this->json([
                'message' => 'Missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }

        // Create a new access token for the user
        $accessToken = new AccessToken();
        $accessToken->setValue(bin2hex(random_bytes(32))); 
        $accessToken->setExpiresAt(new \DateTime('+1 hour'));
        $accessToken->setUser($user);

        // Persist the token in the database
        $entityManager->persist($accessToken);
        $entityManager->flush();

        // Return the token to the client
        return $this->json([
            'user'  => $user->getUserIdentifier(),
            'token' => $accessToken->getValue(),
        ]);
    }
}
