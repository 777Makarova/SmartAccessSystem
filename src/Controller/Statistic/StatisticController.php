<?php

namespace App\Controller\Statistic;


use App\Entity\CheckToken\AccessLog;
use App\Entity\User\User;
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
        $users = $entityManager->getRepository(User::class)->findAll();

        $usersAmount = count($users);


        $lastAccessLog = end($accessLogs);
        $lastUser = $lastAccessLog->user_id_byClaim;
        $lastAccessAttempt = $lastAccessLog->dateCreate;
        $lastAccessAttemptStr = $lastAccessAttempt->format('Y-m-d H:i:s');
        $accessFailures = count($entityManager->getRepository(AccessLog::class)->findBy(array('result' => '0')));

        $userNames = array();

        foreach ($accessLogs as $accessLog) {
            $userId = $accessLog->user_id_byClaim;
            $userName = $entityManager->getRepository(User::class)->findOneBy(array('id' => $userId))->getUsername();
            $userNames[] = $userName;
        }
        $dataForPieChart = array_count_values($userNames);
        $pieChartKeys = array_keys($dataForPieChart);
        $pieChartValues = array_values($dataForPieChart);



        return $this->render('statistic/index.html.twig', [
            'usersAmount' => $usersAmount,
            'lastUser' => $lastUser,
            'lastAccessAttempt' => $lastAccessAttemptStr,
            'accessFailures' => $accessFailures,
            'pieChartKeys' => $pieChartKeys,
            'pieChartValues' => $pieChartValues

        ]);
    }
}


