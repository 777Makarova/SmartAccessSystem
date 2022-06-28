<?php

namespace App\Service\Token;

use App\Entity\CheckToken\AccessLog;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\UnencryptedToken;

class CheckJWTService
{

    public function __construct(private readonly Configuration $configuration, private readonly UserRepository $userRepository, private readonly EntityManagerInterface $entityManager)
    {
    }
    public function parseJWT (array $JWT)
    {
        $data =[];
        $resultArray = [];
        foreach ($JWT as $value) {

            $token = $this->configuration->parser()->parse($value);
            assert($token instanceof UnencryptedToken);

            $claimUserID = $token->claims()->get('user_id'); // returns 4
            $claimRoles = $token->claims()->get('scope'); //returns [{"roles":["ROLE_USER"]}]

            $roleByClaim = $this->userRepository->getRolesByUser(intval($claimUserID))[0]['roles'];
            $checkResult = $this->checkJWT(json_encode($claimRoles),json_encode($roleByClaim));
            $resultArray[] = $checkResult;

            $accessLog = new AccessLog();
            $accessLog->user_id_byClaim = intval($claimUserID);
            $accessLog->roles_byClaim=$roleByClaim;
            $accessLog->token=$value;
            $accessLog->dateCreate = new \DateTime();
            $accessLog->dateUpdate = new \DateTime();
            $accessLog->result = $checkResult;


            print_r(json_encode($accessLog));
            $this->entityManager->persist($accessLog);
            $this->entityManager->flush();

            array_push($data, $value, $claimUserID, $roleByClaim, $checkResult);

//            print_r(json_encode($data));
        }
//        print_r(json_encode($data));
        return $resultArray;
    }


    public function checkJWT(string $actualRole, string $Role): int
    {
        if (strcasecmp($actualRole,$Role)==0)
        {
//            http_response_code(201);
//            echo json_encode(array("message" => "Пользователь был создан."), JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
            return 1;
        }

        else {
//            http_response_code(400);
//            echo json_encode(["message" => "Невозможно создать пользователя."], JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
            return 0;
        }
    }
}