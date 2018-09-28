<?php

namespace Core\Entity;

class RefreshToken
{
    protected $id;

    protected $token;

    protected $device;

    protected $user;

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setDevice($device)
    {
        $this->device = $device;
        return $this;
    }

    public function getDevice()
    {
        return $this->device;
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'token' => $this->getToken(),
            'device' => $this->getDevice(),
            'user' => $this->getUser()->getId()
        ];
    }
}