<?php

namespace Core\Service;

use Core\Entity\RefreshToken;
use Core\Mapper\RefreshTokenMapper;

class RefreshTokenService
{
    protected $refreshTokenMapper;

    /**
     * @param string $user
     * @param string $token
     * @param string $device
     * @return object
     */
    public function find($user, $token, $device)
    {
        return $this->getRefreshTokenMapper()->findOneBy([
            'user' => $user,
            'token' => $token,
            'device' => $device
        ]);
    }

    /**
     * @param $user
     * @return RefreshToken
     */
    public function findByUser($user)
    {
        return $this->getRefreshTokenMapper()->findOneByUser($user);
    }

    /**
     * @param RefreshToken $refreshToken
     * @return mixed
     */
    public function create(RefreshToken $refreshToken)
    {
        return $this->getRefreshTokenMapper()->persist($refreshToken);
    }

    /**
     * @param RefreshTokenMapper $mapper
     * @return $this
     */
    public function setRefreshTokenMapper(RefreshTokenMapper $mapper)
    {
        $this->refreshTokenMapper = $mapper;
        return $this;
    }

    /**
     * @return RefreshTokenMapper
     */
    public function getRefreshTokenMapper()
    {
        return $this->refreshTokenMapper;
    }
}