<?php

namespace App\Entity\CheckToken;


use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\JWTToken\CheckJWTController;


#[ApiResource (
    collectionOperations: [
        'post'=>[
            'deserialize' => false,
            'controller' => CheckJWTController::class,
            'path'=>'api/check_jwt',
            'openapi_context' =>[
                'requestBody' =>[
                    'description' => 'Check JWT Token',
                    'required' => true,
                    'content'=>[
                        'multipart/form-data'=>[
                            'schema'=>[
                                'type' => 'object',
                                'properties' => [
                                    'JWT' => [
                                        'type' => 'string',
                                        'description' => 'Write the JWT'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ],
    itemOperations: ['get'=>[
        'path'=>'api/check_jwt'
    ]]

)]

class CheckJWT
{

    /**
     * @var int|null
     */
    private ?int $id = null;

    /**
     * @var array
     */
    public array $token;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

}