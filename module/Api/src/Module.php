<?php

namespace Api;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\Mvc\MvcEvent;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function onBootstrap(MvcEvent $event)
    {
        $eventManager = $event->getApplication()->getEventManager();
        $sharedManager = $eventManager->getSharedManager();
        $sharedManager->attach(AbstractRestfulController::class,
            MvcEvent::EVENT_DISPATCH, [$this, 'onDispatch'], 1);
    }

    public function onDispatch(MvcEvent $event)
    {
        $serviceManager = $event->getApplication()->getServiceManager();
        $route = $event->getRequest()->getRequestUri();

        $accessManager = $serviceManager->get('core_access_control_service');
        if ($accessManager->allowAccess($route))
        {
            return;
        }

        $res = $event->getResponse();
        $res->setStatusCode(401);
        $res->setContent('Not Authorised');

        return $res;
    }
}