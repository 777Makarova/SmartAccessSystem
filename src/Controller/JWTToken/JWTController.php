<?php

namespace App\Controller\JWTToken;

use App\Entity\CreateToken\Token;
use App\Repository\UserRepository;
use App\Service\Token\JWTService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpFoundation\Request;


#[AsController]
class JWTController extends AbstractController
{

    public function __invoke(Request $request, JWTService $JWTService, UserRepository $repository): JsonResponse|Token
    {
        $user_id_fromPost = $request->get('user_id');

        $user_id_fromBase = $repository->find($user_id_fromPost);
//        print_r(json_encode($user_id_fromBase));
        if ($user_id_fromBase===null){
            return new JsonResponse(['Exception'=>'user does not exist']);
        }
        $role = $repository->getRolesByUser($user_id_fromPost)[0]["roles"];
//        print_r(json_encode($role));
//        print_r(json_encode($role));
        $token = new Token();
        $token->used_id = $request->get('user_id');
        $token->dateUpdate = new \DateTime();
        $token->dateCreate = new \DateTime();
        $token->token = $JWTService->generateJWT($user_id_fromPost, $role);

        return $token;


    }




}