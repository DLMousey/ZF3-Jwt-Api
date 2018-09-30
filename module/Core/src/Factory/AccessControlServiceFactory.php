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
        $accessControlConfig = $container->get('config')['access-control'];
        $missingAclEntryBehaviour = $container->get('config')['missing-access-control-behaviour'];

        $service = new AccessControlService();
        $service->setAccessControlList($accessControlConfig);
        $service->setMissingAclEntryBehaviour($missingAclEntryBehaviour);
        $service->setJwtService($container->get('core_jwt_service'));

        return $service;
    }
}