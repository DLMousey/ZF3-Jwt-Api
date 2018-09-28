<?php

namespace Core\Service;

class UserService
{
    protected $userMapper;

    public function findByEmail($email)
    {
        return $this->getUserMapper()->findOneByEmail($email);
    }

    public function setUserMapper($userMapper)
    {
        $this->userMapper = $userMapper;
        return $this;
    }

    public function getUserMapper()
    {
        return $this->userMapper;
    }
}