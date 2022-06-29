<?php

namespace App\Controller\JWTToken;

use App\Entity\CreateToken\Token;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/token')]
class DeleteJWTController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    /**
     * @throws ORMException
     */
    #[Route('/deletejwt', name: 'app_user_user_create', methods: ['GET', 'POST'])]
    public function delete(Request $request, UserRepository $userRepository): Response
    {
        $token = new Token();
        if ($request->server->get('REQUEST_METHOD')=='POST') {
            $token_id = $request->get('id');


            $token = $this->entityManager->getReference(Token::class, $token_id);
            $this->entityManager->remove($token);
            $this->entityManager->flush();
        }

        return $this->renderForm('token/deleteToken.html.twig', [
            'token' => $token,
        ]);


    }


}