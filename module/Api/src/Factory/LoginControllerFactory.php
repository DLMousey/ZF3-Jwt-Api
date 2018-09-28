<?php

namespace Api\Factory;

use Api\Controller\LoginController;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class LoginControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $userService = $container->get('core_user_service');
        $jwtService = $container->get('core_jwt_service');
        $refreshTokenService = $container->get('core_refresh_token_service');

        $controller = new LoginController();
        $controller->setUserService($userService);
        $controller->setJwtService($jwtService);
        $controller->setRefreshTokenService($refreshTokenService);

        return $controller;
    }
}