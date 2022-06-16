<?php

namespace App\Controller\JWTToken;

use App\Entity\CheckToken\CheckJWT;
use App\Repository\UserRepository;
use App\Service\Token\CheckJWTService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;


#[AsController]
class CheckJWTController extends AbstractController
{

    public function __invoke(Request $request, CheckJWTService $parseJWT, UserRepository $userRepository): CheckJWT
    {
        $JWT = $request->get('JWT');

        $claimsArray= $parseJWT->parseJWT($JWT);
        $user_id = intval($claimsArray[0]);
        $roles = json_encode($claimsArray[1]);

        print_r($roles);
        $token = new CheckJWT();
        $token->token = $parseJWT->parseJWT($JWT);

        $roleByClaim = $userRepository->getRolesByUser($user_id);
        $checkResult = $parseJWT->checkJWT($roles,json_encode($roleByClaim));
        print_r($checkResult);

        print_r(json_encode($roleByClaim));



        return $token;


    }

}