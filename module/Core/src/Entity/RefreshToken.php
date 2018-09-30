<?php

namespace Core\Entity;

class RefreshToken
{
    protected $id;

    protected $token;

    protected $device;

    protected $user;

    protected $revoked;

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $device
     * @return $this
     */
    public function setDevice($device)
    {
        $this->device = $device;
        return $this;
    }

    /**
     * @return string
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param bool $revoked
     * @return $this
     */
    public function setRevoked($revoked)
    {
        $this->revoked = $revoked;
        return $this;
    }

    /**
     * @return bool
     */
    public function getRevoked()
    {
        return $this->revoked;
    }

    /**
     * @return array
     */
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