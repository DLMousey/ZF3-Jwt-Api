<?php


namespace Core\Mapper;

use Doctrine\ORM\EntityRepository;

class BaseMapper extends EntityRepository
{
    public function persist($entity)
    {
        $em = $this->getEntityManager();
        $em->persist($entity);

        $em->flush();
        $em->clear();

        return $entity;
    }
}