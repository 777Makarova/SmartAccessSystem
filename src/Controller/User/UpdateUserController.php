<?php

namespace App\Controller\User;

use App\Entity\User\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user/user')]
class UpdateUserController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager, private UserPasswordHasherInterface $passwordHasher)
    {
    }
    #[Route('/edit', name: 'app_user_user_edit', methods: ['GET', 'POST'])]
    public function update(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        if ($request->server->get('REQUEST_METHOD')=='POST') {

            $username = $request->get('username');
            $email = $request->get('email');
            $password = $request->get('password');
            $roles = $request->get('roles');
            $roles = explode(' '|',',$roles);
            $user_id = $request->get('id');

            $user= $userRepository->find($user_id);
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setPassword($this->passwordHasher->hashPassword($user, $password));
            $user->setRoles($roles);

            $this->entityManager->flush();
        }

        return $this->renderForm('user/user/edit.html.twig', [
            'user' => $user,
        ]);
    }

}