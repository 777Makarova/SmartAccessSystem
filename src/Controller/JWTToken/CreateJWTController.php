<?php

namespace App\Controller\JWTToken;


use App\Entity\CreateToken\Token;
use App\Repository\TokenRepository;
use App\Repository\UserRepository;
use App\Service\Token\JWTService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/token')]
class CreateJWTController extends AbstractController
{

    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }


    #[Route('/', name: 'app_token_index', methods: ['GET'])]

    public function index(TokenRepository $tokenRepository): Response
    {
        return $this->render('token/index.html.twig', [
            'tokens' => $tokenRepository->findAll(),
        ]);
    }

    #[Route('/create', name: 'app_token_create', methods: ['GET', 'POST'])]
    public function createToken(Request $request, UserRepository $userRepository, JWTService $JWTService): Response
    {
        $token = new Token();
        if ($request->server->get('REQUEST_METHOD')=='POST') {

            $user_id_fromPost = $request->get('id');
            $role = $userRepository->getRolesByUser($user_id_fromPost)[0]["roles"];

            $token->used_id = $user_id_fromPost;
            $token->dateUpdate = new \DateTime();
            $token->dateCreate = new \DateTime();
            $token->token = $JWTService->generateJWT($user_id_fromPost, $role);

            $this->entityManager->persist($token);
            $this->entityManager->flush();

        }

        return $this->renderForm('token/createToken.html.twig', [
            'token' => $token,
        ]);



    }






}