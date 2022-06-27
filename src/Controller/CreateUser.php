<?php


namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class CreateUser
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    )
    {
    }

    /**
     * @param User $data
     * @param Request $request
     * @return User
     */
    public function __invoke(User $data, Request $request): User
    {

        $data->setPassword($this->passwordHasher->hashPassword($data, $data->getPassword()));


        return $data;
    }
}