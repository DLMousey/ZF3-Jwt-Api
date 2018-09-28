<?php

namespace Core\Service;

use DateInterval;
use DateTime;

class JwtService
{
    public function generateJwt($user)
    {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);

        $payload = json_encode([
            'exp' => $this->getExpiry(),
            'id' => $user->getId(),
            'email' => $user->getEmail()
        ]);

        $base64Header = $this->base64UrlEncode($header);
        $base64Payload = $this->base64UrlEncode($header);

        $signature = hash_hmac('sha256', $base64Header . "." . $base64Payload, 'abc123', true);
        $base64Signature = $this->base64UrlEncode($signature);

        return $base64Header . "." . $base64Payload . "." . $base64Signature;
    }

    public function verifyJwt($jwt)
    {
        list($encodedHeader, $encodedPayload, $encodedSignature) = explode('.', $jwt);

        $jwtData = $encodedHeader . '.' . $encodedPayload;
        $signature = $this->base64UrlDecode($encodedSignature);

        $newSignature = hash_hmac('sha256', $jwtData, 'abc123', true);

        return hash_equals($signature, $newSignature);
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
}