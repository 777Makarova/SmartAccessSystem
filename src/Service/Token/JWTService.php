<?php

namespace App\Service\Token;

use Lcobucci\JWT\Configuration;

class JWTService
{

    public function __construct(private readonly Configuration $configuration)
    {
    }

    public function generateJWT ($user_id, $roleSet): string
    {
        $now = new \DateTimeImmutable();
        $token = $this->configuration
            ->builder()
            ->issuedAt($now)
            ->withClaim('user_id', $user_id)
            ->withClaim('scope',$roleSet)
            ->getToken($this->configuration->signer(),$this->configuration->signingKey());

        return $token->toString();

    }


    //    public function generateJWT($user_id): string
//    {
//
//        $now = new \DateTimeImmutable();
//        $header = json_encode(['typ'=>'JWT','alg'=>'HS256']);
//        $payload = json_encode(['user_id'=>$user_id]);
//        $base64UrlHeader = str_replace(['+','/', '='],['-', '_', ''],base64_encode($header));
//        $base64UrlPayload = str_replace(['+','/', '='],['-', '_', ''],base64_encode($payload));
//        $signature = hash_hmac('sha256', $base64UrlHeader. ".". $base64UrlPayload,'test',true);
//        $base64UrlSignature = str_replace(['+','/', '='],['-', '_', ''],base64_encode($signature));
//        $token = $base64UrlHeader. ".". $base64UrlPayload. ".". $base64UrlSignature;
//
//        return $token;
//
//    }

}