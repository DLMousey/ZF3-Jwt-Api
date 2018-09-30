<?php

namespace Core\Service;

class AccessControlService
{
    protected $routeGuardsConfig;
    protected $jwtService;

    /**
     * @param $requestUri
     * @return bool
     */
    public function allowAccess($requestUri)
    {
        $routes = $this->getRouteGuardsConfig();
        $match = null;

        foreach($routes as $guard)
        {
            if($guard['route'] == $requestUri)
            {
                $match = $guard;
                break;
            }
        }

        if(!$match['protected']) return true;
        if(!$jwt = $this->getJwt()) return false;
        if(!$this->getJwtService()->verifyJwt($jwt)) return false;
        if(!$this->determineRoleMatch($jwt, $match)) return false;

        return true;
    }

    /**
     * @param string $jwt
     * @param array $matchedGuard
     * @return bool
     */
    private function determineRoleMatch($jwt, $matchedGuard)
    {
        if(!isset($matchedGuard['roles']) || !count($matchedGuard['roles']))
        {
            return true;
        }

        $components = $this->getJwtService()->deconstructJwt($jwt);
        return $components['payload']->roles == $matchedGuard['roles'];
    }

    /**
     * @return bool|string
     */
    private function getJwt()
    {
        if(!array_key_exists('Authorization', getallheaders()))
        {
            return false;
        }

        $headers = getallheaders();
        return $headers['Authorization'] ? str_replace('Bearer ', '', $headers['Authorization']) : false;
    }

    /**
     * @param array $config
     * @return $this
     */
    public function setRouteGuardsConfig(array $config)
    {
        $this->routeGuardsConfig = $config;
        return $this;
    }

    /**
     * @return array
     */
    public function getRouteGuardsConfig()
    {
        return $this->routeGuardsConfig;
    }

    /**
     * @param JwtService $jwtService
     * @return $this
     */
    public function setJwtService(JwtService $jwtService)
    {
        $this->jwtService = $jwtService;
        return $this;
    }

    /**
     * @return JwtService
     */
    public function getJwtService()
    {
        return $this->jwtService;
    }
}