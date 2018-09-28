<?php

namespace Api;

use Zend\Mvc\MvcEvent;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function onBootstrap(MvcEvent $event)
    {
        /**
         * @todo - Check controller action against a mapping of routes and what roles you need to access them,
         * validate JWT and hand off to action
         */
    }
}