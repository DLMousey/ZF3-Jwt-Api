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

        /**
         * Base64URL encode the header and payload, PHP doesn't have built in
         * B64URL Support so we'll do it manually replacing invalid characters
         */
        $base64Header = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64Payload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        /**
         * Create the hash for the signature
         */
        $signature = hash_hmac('sha256', $base64Header . "." . $base64Payload, 'abc123', true);

        /**
         * Do the same Base64 url encode on the signature
         */
        $base64Signature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        /**
         * Concatenate the parts together and return
         */
        return $base64Header . "." . $base64Payload . "." . $base64Signature;
    }

    private function getExpiry()
    {
        $dt = new DateTime();
        $dt->add(new DateInterval('PT15M'));

        return $dt->getTimestamp();
    }
}