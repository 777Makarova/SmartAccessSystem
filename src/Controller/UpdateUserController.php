<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user/user')]
class UpdateUserController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }
    #[Route('/edit', name: 'app_user_user_edit', methods: ['GET', 'POST'])]
    public function update(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        if ($request->server->get('REQUEST_METHOD')=='POST') {

            $username = $request->get('username');
            $password = $request->get('password');
            $roles = $request->get('roles');
            $roles = explode(' ',$roles);
            $user_id = $request->get('id');

            $user= $userRepository->find($user_id);
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setRoles($roles);

            $this->entityManager->flush();

//            $userUpdate = $userRepository->update($username,$password,$roles,$user_id);
//           dd ($userUpdate);


//            $user = $userRepository->find($id);
//            $user->email = $request->get('username');
//            $user->password = $request->get('password');
//            $user->roles = $roles;
//            $user->dateCreate = new \DateTime();
//            $user->dateUpdate = new \DateTime();





//            $user->email = $request->get('username');
//            $user->password = $request->get('password');
//            $user->roles= $roles;

//
//            $this->entityManager->persist($user);
//            $this->entityManager->flush();

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