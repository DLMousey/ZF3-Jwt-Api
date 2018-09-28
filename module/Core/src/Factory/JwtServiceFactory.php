<?php

namespace Core\Factory;

use Core\Service\JwtService;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class JwtServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new JwtService();
    }
}