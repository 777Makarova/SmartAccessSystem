<?php

namespace App\Repository\OAuthTest;

use App\Entity\OAuthTest\AuthCodeEntity;
use App\Interface\OAuthTest\AuthorizationCodeRepositoryInterface;
use App\Models\OauthTest\AuthorizationCode;
use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Repositories\AuthCodeRepositoryInterface;

class AuthCodeRepository implements AuthCodeRepositoryInterface
{

    private AuthorizationCodeRepositoryInterface $AuthorizationCodeRepository;

    public function __construct(AuthorizationCodeRepositoryInterface $AuthorizationCodeRepository)
    {
        $this->AuthorizationCodeRepository = $AuthorizationCodeRepository;
    }

    public function getNewAuthCode(): AuthCodeEntityInterface
    {
        return new AuthCodeEntity();
    }
    public function persistNewAuthCode(AuthCodeEntityInterface $authCodeEntity){
        $authCodePersistEntity = new AuthorizationCode(
        $authCodeEntity->getIdentifier(),
        $authCodeEntity->getUserIdentifier(),
        $authCodeEntity->getClient()->getIdentifier(),
        $this->scopesToArray($authCodeEntity->getScopes()),
        false,
        $authCodeEntity->getExpiryDateTime()
    );
        $this->AuthorizationCodeRepository->save($authCodePersistEntity);
    }

    private function scopesToArray(array $getScopes): array
    {
        return array_map(function ($scope) {return $scope->getIdentifier();}, $getScopes);
    }



    public function revokeAuthCode($codeId)
    {
        // Some logic to revoke the auth code in a database
    }

    public function isAuthCodeRevoked($codeId)
    {
        return false; // The auth code has not been revoked
    }



}