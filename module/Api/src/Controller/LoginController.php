<?php


namespace Api\Controller;

use Core\Entity\RefreshToken;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class LoginController extends AbstractRestfulController
{
    protected $userService;
    protected $jwtService;
    protected $refreshTokenService;

    public function create($data)
    {
        if(!$user = $this->getUserService()->findByEmail($data['email']))
        {
            $this->getResponse()->setStatusCode(400);
            return new JsonModel(['message' => 'Invalid credentials']);
        }

        if(!password_verify($data['password'], $user->getPassword()))
        {
            $this->getResponse()->setStatusCode(400);
            return new JsonModel(['message' => 'Invalid credentials']);
        }

        $token = $this->getJwtService()->generateJwt($user);

        $refreshToken = new RefreshToken();
        $refreshToken->setToken(base64_encode('abc123'));
        $refreshToken->setDevice('main-app');
        $refreshToken->setUser($user);

        $refreshToken = $this->getRefreshTokenService()->create($refreshToken);

        return new JsonModel([
            'token' => $token,
            'refresh_token' => $refreshToken->getToken()
        ]);
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

    public function setJwtService($jwtService)
    {
        $this->jwtService = $jwtService;
        return $this;
    }

    public function getJwtService()
    {
        return $this->jwtService;
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
}