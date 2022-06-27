<?php

namespace App\Controller\User;

use App\Entity\User\User;
use App\Form\User\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user/user')]
class UserController extends AbstractController
{

    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    #[Route('/', name: 'app_user_user_index', methods: ['GET'])]

    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }


    #[Route('/new', name: 'app_user_user_new', methods: ['GET', 'POST'])]
    public function update(Request $request, UserRepository $userRepository): Response
    {


        $user = new User();
        if ($request->server->get('REQUEST_METHOD')=='POST'){

            $roles = $request->get('roles');
            $roles = explode(' ',$roles);
            $user->email = $request->get('username');
            $user->password = $request->get('password');
            $user->roles= $roles;
            $user->dateCreate = new \DateTime();
            $user->dateUpdate = new \DateTime();

            $this->entityManager->persist($user);
            $this->entityManager->flush();


        }
        // $form = $this->createForm(UserType::class, $user);
        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        //     $userRepository->add($user, true);

        //     return $this->redirectToRoute('app_user_user_index', [], Response::HTTP_SEE_OTHER);
        // }

        return $this->renderForm('user/user/new.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_user_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/user/show.html.twig', [
            'user' => $user,
        ]);
    }

//    #[Route('/edit', name: 'app_user_user_edit', methods: ['GET', 'POST'])]
//    public function edit(Request $request, UserRepository $userRepository): Response
//    {
////        $user = new User();
//        // $form = $this->createForm(UserType::class, $user);
//        // $form->handleRequest($request);
//
//        // if ($form->isSubmitted() && $form->isValid()) {
//        //     $userRepository->add($user, true);
//
//        //     return $this->redirectToRoute('app_user_user_index', [], Response::HTTP_SEE_OTHER);
//        // }
//
//        return $this->renderForm('user/user/edit.html.twig', [
////            'user' => $user,
//        ]);
//    }
//    #[Route('/edit', name: 'app_user_user_edit', methods: ['GET', 'POST'])]
//    public function edit(Request $request, User $user, UserRepository $userRepository): Response
//    {
//
//        $user = new User();
////        $form = $this->createForm(UserType::class, $user);
////        $form->handleRequest($request);
////
////        if ($form->isSubmitted() && $form->isValid()) {
////            $userRepository->add($user, true);
////
////            return $this->redirectToRoute('app_user_user_index', [], Response::HTTP_SEE_OTHER);
////        }

//        return $this->renderForm('user/user/edit.html.twig', [
//            'user' => $user,
////            'form' => $form,
//        ]);
//    }

//    #[Route('/{id}', name: 'app_user_user_delete', methods: ['POST'])]
//    public function delete(Request $request, User $user, UserRepository $userRepository): Response
//    {
//        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
//            $userRepository->remove($user, true);
//        }
//
//        return $this->redirectToRoute('app_user_user_index', [], Response::HTTP_SEE_OTHER);
//    }
}
