<?php

namespace App\Controller\User;

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
        if ($request->server->get('REQUEST_METHOD')=='POST') {

            $roles = $request->get('roles');
            $roles = explode(' ',$roles);
            $id = $request->get('id');
            $user = $userRepository->find($id);
            $user->email = $request->get('username');
            $user->password = $request->get('password');
            $user->roles = $roles;
            $user->dateCreate = new \DateTime();
            $user->dateUpdate = new \DateTime();





//            $user->email = $request->get('username');
//            $user->password = $request->get('password');
//            $user->roles= $roles;

//
            $this->entityManager->persist($user);
            $this->entityManager->flush();

        }
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