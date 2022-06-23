<?php

namespace App\Controller\JWTToken;

use App\Service\Token\CheckJWTService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;


#[AsController]
class CheckJWTController extends AbstractController
{

    #[Route(
        '/check_jwt',
        name: 'check_jwt',
        methods: ['POST']
    )]


    public function __invoke(Request $request, CheckJWTService $parseJWT):Response
    {
        $JWT = $request->get('JWT');
        $JWT = explode(', ',$JWT);

        $data= $parseJWT->parseJWT($JWT);

        $response = new Response();
        $response->setContent(implode(PHP_EOL, $data));

        return $response;
    }
}