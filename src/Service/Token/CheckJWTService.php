<?php

namespace App\Service\Token;

use App\Repository\UserRepository;
use http\Exception\RuntimeException;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\UnencryptedToken;
use Lcobucci\JWT\Validation\Constraint\SignedWith;

class CheckJWTService
{

    public function __construct(private readonly Configuration $configuration)
    {

    }



    public function parseJWT ($JWT)
    {
        $token = $this->configuration->parser()->parse($JWT);
        assert($token instanceof UnencryptedToken);

//        $this->configuration->setValidationConstraints(
//            new SignedWith($this->configuration->signer(),$this->configuration->signingKey())
//        );
//        $constraints = $this->configuration->validationConstraints();
//        if (! $this->configuration->validator()->validate($token,...$constraints))
//        {
//            throw new RuntimeException('no');
//        }

        $claimUserID = $token->claims()->get('user_id'); // returns 4
        $claimRoles = $token->claims()->get('scope'); //returns [{"roles":["ROLE_USER"]}]

        $claims =[$claimUserID,$claimRoles];

        return $claims;
    }


    /**
     * @param string $actualRole
     * @param string $Role
     * @return int
     */
    public function checkJWT(string $actualRole, string $Role): int
    {
        if (strcasecmp($actualRole,$Role)==0)
        {
            return 1;
        }
        return 0;
    }

    /**
     * @param $token
     * @return false|string
     */
    public function decodeJWT($token): bool|string
    {
        return base64_decode($token);
    }

    public function checkkJWT (string $claim): string
    {
        $claimArray = explode(",",$claim);
        $claimUserID = next($claimArray);
        $claimScope = next($claimArray);
        $pattern = '/\D/';
        $receivedUserID=preg_replace($pattern, "", $claimUserID);

        return $receivedUserID;

    }

}