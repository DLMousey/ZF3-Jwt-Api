<?php

namespace Core\Service;

class RefreshTokenService
{
    protected $refreshTokenMapper;

    public function find($user, $token, $device)
    {
        return $this->getRefreshTokenMapper()->findOneBy([
            'user' => $user,
            'token' => $token,
            'device' => $device
        ]);
    }

    public function findByUser($user)
    {
        return $this->getRefreshTokenMapper()->findOneByUser($user);
    }

    public function create($refreshToken)
    {
        return $this->getRefreshTokenMapper()->persist($refreshToken);
    }

    public function setRefreshTokenMapper($mapper)
    {
        $this->refreshTokenMapper = $mapper;
        return $this;
    }

    public function getRefreshTokenMapper()
    {
        return $this->refreshTokenMapper;
    }
}