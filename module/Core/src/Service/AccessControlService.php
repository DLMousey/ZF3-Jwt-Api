<?php

namespace Core\Service;

class AccessControlService
{
    protected $routeGuardsConfig;
    protected $jwtService;

    public function allowAccess($route)
    {
        $routes = $this->getRouteGuardsConfig();
        $match = null;

        foreach($routes as $guard)
        {
            if($guard['route'] == $route)
            {
                $match = $guard;
                break;
            }
        }

        if(!$match['protected']) return true;

        if(!$jwt = $this->getJwt()) return false;

        if(!$this->getJwtService()->verifyJwt($jwt)) return false;

        return true;
    }

    private function getJwt()
    {
        $headers = getallheaders();
        return $headers['Authorization'] ? str_replace('Bearer ', '', $headers['Authorization']) : false;
    }

    public function setRouteGuardsConfig($config)
    {
        $this->routeGuardsConfig = $config;
        return $this;
    }

    public function getRouteGuardsConfig()
    {
        return $this->routeGuardsConfig;
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