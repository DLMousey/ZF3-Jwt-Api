<?php

namespace Core\Service;

class AccessControlService
{
    protected $missingAclEntryBehaviour;
    protected $accessControlList;
    protected $jwtService;

    /**
     * @param $requestUri
     * @return bool
     */
    public function allowAccess($requestUri)
    {
        $aclEntries = $this->getAccessControlList();
        $match = null;

        foreach($aclEntries as $acl)
        {
            if($acl['route'] == $requestUri)
            {
                $match = $acl;
                break;
            }
        }

        if($match == null)
        {
            return $this->getMissingAclEntryBehaviour();
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
     * @param int $missingAclEntryBehaviour
     * @return $this
     */
    public function setMissingAclEntryBehaviour($missingAclEntryBehaviour)
    {
        $this->missingAclEntryBehaviour = $missingAclEntryBehaviour;
        return $this;
    }

    /**
     * @return int
     */
    public function getMissingAclEntryBehaviour()
    {
        return $this->missingAclEntryBehaviour;
    }

    /**
     * @param array $accessControlList
     * @return $this
     */
    public function setAccessControlList(array $accessControlList)
    {
        $this->accessControlList = $accessControlList;
        return $this;
    }

    /**
     * @return array
     */
    public function getAccessControlList()
    {
        return $this->accessControlList;
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