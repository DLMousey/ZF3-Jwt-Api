<?php

namespace Core\Service;

use DateInterval;
use DateTime;

class JwtService
{
    protected $jwtConfig;

    public function generateJwt($user)
    {
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

        $signingKey = $this->getJwtConfig()['signing_key'];

        $base64Header = $this->base64UrlEncode($header);
        $base64Payload = $this->base64UrlEncode($payload);

        $signature = hash_hmac('sha256', $base64Header . "." . $base64Payload, $signingKey, true);
        $base64Signature = $this->base64UrlEncode($signature);

        return $base64Header . "." . $base64Payload . "." . $base64Signature;
    }

    public function verifyJwt($jwt)
    {
        list($encodedHeader, $encodedPayload, $encodedSignature) = explode('.', $jwt);

        $decodedPayload = json_decode(base64_decode($encodedPayload));
        $jwtData = $encodedHeader . '.' . $encodedPayload;
        $signature = $this->base64UrlDecode($encodedSignature);

        $signingKey = $this->getJwtConfig()['signing_key'];

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