<?php

namespace Api\Factory;

use Api\Controller\VerificationController;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class VerificationControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $service = $container->get('core_jwt_service');

        $controller = new VerificationController();
        $controller->setJwtService($service);

        return $controller;
    }
}