<?php


namespace Api\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class UnprotectedResourceController extends AbstractRestfulController
{
    public function getList()
    {
        return new JsonModel([
            'public_key' => 'public_value'
        ]);
    }
}