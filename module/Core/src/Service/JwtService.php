<?php

namespace Core\Service;

use DateInterval;
use DateTime;

use Core\Utility\Base64Utility;

class JwtService
{
    protected $jwtConfig;

    public function generateJwt($user)
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

    public function verifyJwt($jwt)
    {
        $signingKey = $this->getJwtConfig()['signing_key'];
        list($encodedHeader, $encodedPayload, $encodedSignature) = explode('.', $jwt);

        $decodedPayload = json_decode(base64_decode($encodedPayload));
        $signature = base64_decode($encodedSignature);
        $jwtData = $encodedHeader . '.' . $encodedPayload;

        $newSignature = hash_hmac('sha256', $jwtData, $signingKey, true);

        $now = new DateTime();
        $expiry = new DateTime('@' . $decodedPayload->exp);

        return hash_equals($signature, $newSignature) && ($now < $expiry);
    }

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

    private function base64UrlEncode($data)
    {
        $safeData = strtr(base64_encode($data), '+/', '-_');
        return rtrim($safeData, '=');
    }

    private function base64UrlDecode($data)
    {
        $unsafeData = strtr($data, '-_', '+/');
        $paddedData = str_pad($unsafeData, strlen($data) % 4, '=', STR_PAD_RIGHT);
        return base64_decode($paddedData);
    }

    private function getExpiry()
    {
        $dt = new DateTime();
        $dt->add(new DateInterval('PT15M'));

        return $dt->getTimestamp();
    }

    public function setJwtConfig($config)
    {
        $this->jwtConfig = $config;
        return $this;
    }

    public function getJwtConfig()
    {
        return $this->jwtConfig;
    }
}