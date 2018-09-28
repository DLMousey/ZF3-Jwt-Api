<?php


namespace Api\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class VerificationController extends AbstractRestfulController
{
    protected $jwtService;

    public function create($data)
    {
        if(!$this->getJwtService()->verifyJwt($data['token']))
        {
            $this->getResponse()->setStatusCode(401);
            return new JsonModel();
        }

        return new JsonModel();
    }

    public function setJwtService($jwtService)
    {
        $this->jwtService = $jwtService;
        return $this;
    }

    public function getJwtService()
    {
        return $this->jwtService;
    }
}