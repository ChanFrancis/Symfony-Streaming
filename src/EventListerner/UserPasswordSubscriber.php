<?php

declare(strict_types=1);

namespace App\EventLister;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsEntityListener(event: Events::prePersist, entity: User::class)]
#[AsEntityListener(event: Events::preUpdate, entity: User::class)]
readOnly class UserPasswordSubscriber
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
        
    }

    public function preUpdate(User $user): void
    {
        $this->encodePassword($user);
    }

    public function encodePassword(User $user): void
    {
        $plainPassword = $user->getPlainPassword();

        if (!$plainPassword) {
            return;
        }

        $encodedPassword = $this->passwordHasher->hashPassword($user, $plainPassword);

        $this->encodePassword($user);
    }
}