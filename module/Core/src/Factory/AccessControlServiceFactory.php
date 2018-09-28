<?php

namespace Core\Factory;

use Core\Service\AccessControlService;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class AccessControlServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config')['route-guards'];

        $service = new AccessControlService();
        $service->setRouteGuardsConfig($config);
        $service->setJwtService($container->get('core_jwt_service'));

        return $service;
    }
}