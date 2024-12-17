<?php

declare(strict_types=1);

namespace App\Controller\Other;

use App\Repository\SubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\User;

class SubscriptionController extends AbstractController
{
    #[Route('/subscriptions', name: 'page_subscription')]
    public function index(SubscriptionRepository $subscriptionRepository): Response
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            throw $this->createAccessDeniedException('You must be logged in to access this page.');
        }

        $subscriptionId = $user->getCurrentSubscription();

        if (!$subscriptionId) {
            throw $this->createNotFoundException('No subscription associated with this user.');
        }

        $subscription = $subscriptionRepository->find($subscriptionId);

        if (!$subscription) {
            throw $this->createNotFoundException('Subscription not found.');
        }

        return $this->render('other/abonnements.html.twig', [
            'subscription' => $subscription,
        ]);
    }
}
