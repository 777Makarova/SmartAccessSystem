<?php

namespace App\Controller\User;

use App\Entity\User\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user/user')]
class UpdateUserController extends AbstractController
{
    #[Route('/edit', name: 'app_user_user_edit', methods: ['GET', 'POST'])]
    public function update(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        // $form = $this->createForm(UserType::class, $user);
        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        //     $userRepository->add($user, true);

        //     return $this->redirectToRoute('app_user_user_index', [], Response::HTTP_SEE_OTHER);
        // }

        return $this->renderForm('user/user/edit.html.twig', [
            'user' => $user,
        ]);
    }

}