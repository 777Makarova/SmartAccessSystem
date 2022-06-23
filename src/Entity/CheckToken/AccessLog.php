<?php

namespace App\Entity\CheckToken;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\BaseEntity\BaseEntity;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;



use App\Controller\JWTToken\CheckJWTController;
use Doctrine\ORM\Mapping\Entity;


//#[ApiResource (
//    collectionOperations: [
//        'post'=>[
//            'deserialize' => false,
//            'controller' => CheckJWTController::class,
//            'path'=>'api/check_jwt',
//            'openapi_context' =>[
//                'requestBody' =>[
//                    'description' => 'Check JWT Token',
//                    'required' => true,
//                    'content'=>[
//                        'multipart/form-data'=>[
//                            'schema'=>[
//                                'type' => 'object',
//                                'properties' => [
//                                    'JWT' => [
//                                        'type' => 'string',
//                                        'description' => 'Write the JWT'
//                                    ]
//                                ]
//                            ]
//                        ]
//                    ]
//                ]
//            ]
//        ]
//    ],
//    itemOperations: ['get'=>[
//        'path'=>'check_token'
//    ]]
//
//)]
#[ORM\Entity]
class AccessLog
{

    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string')]
    public string $user_id_byClaim;

    /**
     * @var array
     */
    #[ORM\Column(type: 'json')]
    public array $roles_byClaim;

    #[ORM\Column(type: 'text')]
    public string $token;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

}