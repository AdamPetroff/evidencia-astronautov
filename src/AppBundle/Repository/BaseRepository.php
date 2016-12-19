<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 18. 12. 2016
 * Time: 20:33
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

abstract class BaseRepository extends EntityRepository
{
    public function save($superpower)
    {
        $this->getEntityManager()->persist($superpower);
        $this->getEntityManager()->flush();
    }
}