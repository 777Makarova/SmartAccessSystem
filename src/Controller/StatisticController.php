<?php

namespace App\Controller;


use App\Entity\CheckToken\AccessLog;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class StatisticController extends AbstractController
{
    #[Route('/statistic', name: 'app_statistic')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        $accessLogs = $entityManager->getRepository(AccessLog::class)->findAll();
        $usersAmount = count($entityManager->getRepository(User::class)->findAll());

        $lastAccessLog = end($accessLogs);
        $lastUser = $lastAccessLog->user_id_byClaim;

        $lastAccessAttempt = $lastAccessLog->dateCreate;

        $accessFailures = count($entityManager->getRepository(AccessLog::class)->findBy(array('result'=> '0')));





        return $this->render('statistic/index.html.twig', [
            'usersAmount' => $usersAmount,
            'lastUser' => $lastUser,
            'lastAccessAttempt' => $lastAccessAttempt,
            'accessFailures' => $accessFailures
        ]);
    }
}
