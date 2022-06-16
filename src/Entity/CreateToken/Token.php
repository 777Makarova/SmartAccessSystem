<?php

namespace App\Entity\CreateToken;


use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\JWTToken\JWTController;
use App\Entity\BaseEntity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity]
#[ApiResource (
    collectionOperations: [
        'post'=>[
            'deserialize' => false,
            'controller' => JWTController::class,
            'openapi_context' =>[
                'requestBody' =>[
                    'description' => 'Get JWT Token',
                    'required' => true,
                    'content'=>[
                        'multipart/form-data'=>[
                            'schema'=>[
                                'type' => 'object',
                                'properties' => [
                                    'user_id' => [
                                        'type' => 'string',
                                        'description' => 'Write the user_id'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ],
    itemOperations: ['get']

)]

class Token extends BaseEntity
{

    #[ORM\Column(type:'string')]
    #[Assert\NotNull]
    public string $used_id;

    #[ORM\Column(type:'string')]
    #[Assert\NotNull]
    public string $token;

    public function getUsedId(): string
    {
        return $this->used_id;
    }

    public function setUsedId(string $used_id): void
    {
        $this->used_id = $used_id;
    }

}