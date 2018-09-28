<?php

namespace Api\Factory;

use Api\Controller\RefreshController;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class RefreshControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $jwtService = $container->get('core_jwt_service');
        $refreshTokenService = $container->get('core_refresh_token_service');
        $userService = $container->get('core_user_service');

        $controller = new RefreshController();
        $controller->setJwtService($jwtService);
        $controller->setRefreshTokenService($refreshTokenService);
        $controller->setUserService($userService);

        return $controller;
    }
}