<?php

namespace Api\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class RefreshController extends AbstractRestfulController
{
    protected $refreshTokenService;
    protected $jwtService;
    protected $userService;

    public function create($data)
    {
        $jwt = $data['token'];
        $refreshToken = $data['refresh_token'];

        $parts = explode('.', $jwt);
        $payload = json_decode(base64_decode($parts[1]));

        $user = $this->getUserService()->findByEmail($payload->email);
        $refreshTokenEntity = $this->getRefreshTokenService()->find($user, $refreshToken, 'main-app');

        if($refreshTokenEntity == null || $refreshTokenEntity->getRevoked())
        {
            $this->getResponse()->setStatusCode(401);
            return new JsonModel();
        }

        $newJwt = $this->getJwtService()->generateJwt($user);

        return new JsonModel([
            'token' => $newJwt,
            'refresh_token' => $refreshToken
        ]);
    }

    public function setRefreshTokenService($refreshTokenService)
    {
        $this->refreshTokenService = $refreshTokenService;
        return $this;
    }

    public function getRefreshTokenService()
    {
        return $this->refreshTokenService;
    }

    public function setJwtService($jwtService)
    {
        $this->jwtService = $jwtService;
        return $this;
    }

    public function getJwtService()
    {
        return $this->jwtService;
    }

    public function setUserService($userService)
    {
        $this->userService = $userService;
        return $this;
    }

    public function getUserService()
    {
        return $this->userService;
    }
}