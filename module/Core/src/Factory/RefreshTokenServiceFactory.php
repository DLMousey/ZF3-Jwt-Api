<?php

namespace Core\Factory;

use Core\Service\RefreshTokenService;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class RefreshTokenServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $em = $container->get('doctrine.entitymanager.orm_default');
        $repo = $em->getRepository('Core\Entity\RefreshToken');

        $service = new RefreshTokenService();
        $service->setRefreshTokenMapper($repo);

        return $service;
    }
}