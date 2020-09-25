<?php

namespace App\Security\Voter;

use App\Security\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class RandomNumberVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        return $attribute === 'VIEW' && is_numeric($subject);
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof User) {
            return false;
        }

        return $subject < 20;
    }
}
