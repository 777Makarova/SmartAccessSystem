<?php

namespace App\OpenAPI;



use ApiPlatform\Core\OpenApi\OpenApi;

interface ExpandOpenApiInterface
{
    public function apply(OpenApi $openApi): void;
}
