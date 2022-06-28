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
        //        создать в табллице юзер поле date_of_attempt
        //        $lastAccessAttempt = $lastAccessLog['date_of_attempt']

        $lastAccessAttempt = '27.08.22 12:34:46';
        //        создать в табллице юзер поле $accessFailures
        $accessFailures = '4';







        return $this->render('statistic/index.html.twig', [
            'usersAmount' => $usersAmount,
            'lastUser' => $lastUser,
            'lastAccessAttempt' => $lastAccessAttempt,
            'accessFailures' => $accessFailures
        ]);
    }
}
