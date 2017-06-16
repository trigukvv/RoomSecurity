<?php

namespace AppBundle\Repository;

/**
 * SensorStatusRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SensorStatusRepository extends \Doctrine\ORM\EntityRepository
{
    public function getLatestStatus($sensor)
    {
        $query=$this->createQueryBuilder('ss')
            ->where('ss.sensor = :sensor')
            ->setParameter('sensor',$sensor)
            ->orderBy('ss.id','DESC')
            ->setMaxResults(1)
            ->getQuery();
        return $query->getSingleResult();        
    }
}