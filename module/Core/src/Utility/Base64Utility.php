<?php


namespace Core\Utility;

class Base64Utility
{
    static public function UrlEncode($data)
    {
        $encodedData = base64_encode($data);
        $safeData = strtr($encodedData, '+/', '-_');
        return rtrim($safeData, '=');
    }

    static public function UrlDecode($data)
    {
        $unsafeData = strtr($data, '-_', '+/');
        $paddedData = str_pad($unsafeData, strlen($data) % 4, '=', STR_PAD_RIGHT);
        return base64_decode($paddedData);
    }
}