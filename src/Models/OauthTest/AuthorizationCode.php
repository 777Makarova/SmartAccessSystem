<?php

namespace App\Models\OauthTest;

use DateTimeInterface;

class AuthorizationCode
{

    private string $id;

    private ?string $userId;

    private string $clientId;

    private array $scopes = [];

    private bool $revoked = false;

    private DateTimeInterface $expiresAt;

    public function __construct(string $id, ?string $userId, string $clientId, array $scopes, bool $revoked, DateTimeInterface $expiresAt)
    {
        $this->id=$id;
        $this->userId=$userId;
        $this->clientId=$clientId;
        $this->scopes=$scopes;
        $this->revoked=$revoked;
        $this->expiresAt=$expiresAt;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getUserId(): ?string
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @return array
     */
    public function getScopes(): array
    {
        return $this->scopes;
    }

    /**
     * @return bool
     */
    public function isRevoked(): bool
    {
        return $this->revoked;
    }

    public function revoke(): void
    {
        $this->revoked = true;
    }

    /**
     * @return DateTimeInterface
     */
    public function getExpiresAt(): DateTimeInterface
    {
        return $this->expiresAt;
    }


}