<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index( UserRepository $userRepository  
    ): Response
    {
        $userRole = $userRepository->getRolesByUser('4');

        return $this->render('user/index.html.twig', [
        'roles'=>$userRole
        ]);
    }
}
