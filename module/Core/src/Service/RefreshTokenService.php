<?php

namespace Core\Service;

class RefreshTokenService
{
    protected $refreshTokenMapper;

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