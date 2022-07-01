<?php

namespace App\Controller\User;

use App\Entity\User\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user/user')]
class DeleteUserController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    /**
     * @throws ORMException
     */
    #[Route('/delete', name: 'app_user_user_delete', methods: ['GET', 'POST'])]
    public function delete(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        if ($request->server->get('REQUEST_METHOD')=='POST') {
            $user_id = $request->get('id');
            $user = $this->entityManager->getReference(User::class, $user_id);
            $this->entityManager->remove($user);
            $this->entityManager->flush();
        }



        return $this->renderForm('user/user/delete.html.twig', [
            'user' => $user,
        ]);

    }

}