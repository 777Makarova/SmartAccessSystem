<?php

namespace App\Controller\JWTToken;

use App\Entity\CreateToken\Token;
use App\Repository\UserRepository;
use App\Service\Token\JWTService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpFoundation\Request;


#[AsController]
class JWTController extends AbstractController
{

    public function __invoke(Request $request, JWTService $JWTService, UserRepository $repository): Token
    {
        $user_id = $request->get('user_id');
        $role = $repository->getRolesByUser($user_id);
        print_r(json_encode($role));

//        print_r(json_encode($role));
        $token = new Token();
        $token->used_id = $request->get('user_id');
        $token->dateUpdate = new \DateTime();
        $token->dateCreate = new \DateTime();
        $token->token = $JWTService->generateJWT($user_id, $role);

        return $token;


    }




}