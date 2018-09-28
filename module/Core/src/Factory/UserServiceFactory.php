<?php

namespace Core\Factory;

use Core\Service\UserService;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class UserServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $em = $container->get('doctrine.entitymanager.orm_default');
        $repo = $em->getRepository('Core\Entity\User');

        $service = new UserService();
        $service->setUserMapper($repo);

        return $service;
    }
}