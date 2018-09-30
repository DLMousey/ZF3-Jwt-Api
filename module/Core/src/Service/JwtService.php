<?php

namespace Core\Service;

use Core\Entity\User;
use DateInterval;
use DateTime;

use Core\Utility\Base64Utility;

class JwtService
{
    protected $jwtConfig;

    /**
     * @param User $user
     * @return string
     */
    public function generateJwt(User $user)
    {
        $signingKey = $this->getJwtConfig()['signing_key'];
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);

        $roles = [];
        foreach($user->getRoles() as $role)
        {
            $roles[] = $role->getRole();
        }

        $payload = json_encode([
            'exp' => $this->getExpiry(),
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'roles' => $roles
        ]);

        $base64Header = Base64Utility::UrlEncode($header);
        $base64Payload = Base64Utility::UrlEncode($payload);

        $signature = hash_hmac('sha256', $base64Header . "." . $base64Payload, $signingKey, true);
        $base64Signature = Base64Utility::UrlEncode($signature);

        return $base64Header . "." . $base64Payload . "." . $base64Signature;
    }

    /**
     * @param string $jwt
     * @return bool
     */
    public function verifyJwt($jwt)
    {
        $signingKey = $this->getJwtConfig()['signing_key'];
        list($encodedHeader, $encodedPayload, $encodedSignature) = explode('.', $jwt);

        $decodedPayload = json_decode(Base64Utility::UrlDecode($encodedPayload));
        $signature = Base64Utility::UrlDecode($encodedSignature);
        $jwtData = $encodedHeader . '.' . $encodedPayload;

        $newSignature = hash_hmac('sha256', $jwtData, $signingKey, true);

        $now = new DateTime();
        $expiry = new DateTime('@' . $decodedPayload->exp);

        return hash_equals($signature, $newSignature) && ($now < $expiry);
    }

    /**
     * @param $jwt
     * @return array
     */
    public function deconstructJwt($jwt)
    {
        $parts = explode('.', $jwt);
        $header = json_decode(base64_decode($parts[0]));
        $payload = json_decode(base64_decode($parts[1]));

        return [
            'header' => $header,
            'payload' => $payload
        ];
    }

    /**
     * @return int
     * @throws \Exception
     */
    private function getExpiry()
    {
        $dt = new DateTime();
        $dt->add(new DateInterval('PT15M'));

        return $dt->getTimestamp();
    }

    /**
     * @param array $jwtConfig
     * @return $this
     */
    public function setJwtConfig(array $jwtConfig)
    {
        $this->jwtConfig = $jwtConfig;
        return $this;
    }

    /**
     * @return array
     */
    public function getJwtConfig()
    {
        return $this->jwtConfig;
    }
}