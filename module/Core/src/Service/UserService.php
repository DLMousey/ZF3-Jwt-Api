<?php

namespace Core\Service;

use Core\Entity\User;
use Core\Mapper\UserMapper;

class UserService
{
    protected $userMapper;

    /**
     * @param string $email
     * @return User
     */
    public function findByEmail($email)
    {
        return $this->getUserMapper()->findOneByEmail($email);
    }

    /**
     * @param UserMapper $userMapper
     * @return $this
     */
    public function setUserMapper(UserMapper $userMapper)
    {
        $this->userMapper = $userMapper;
        return $this;
    }

    /**
     * @return UserMapper
     */
    public function getUserMapper()
    {
        return $this->userMapper;
    }
}