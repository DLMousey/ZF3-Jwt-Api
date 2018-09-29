<?php


namespace Api\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class ProtectedResourceController extends AbstractRestfulController
{
    public function getList()
    {
        return new JsonModel([
            'secret_key' => 'secret_value'
        ]);
    }
}