<?php

namespace App\Controller\User;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Token\CheckJWTService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;

class UserController extends AbstractController
{

    #[Route('/user', name: 'app_user')]
    public function index(UserRepository $userRepository):Response
    {
        $userRole = $userRepository->getRolesByUser('4')[0]["roles"];
//        $userRole = implode(' ', $userRole);

        return $this->render('user/index.html.twig', ['roles'=> $userRole]);

    }
}