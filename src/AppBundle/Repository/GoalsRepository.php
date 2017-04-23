<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Goals;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GoalsRepository extends \Doctrine\ORM\EntityRepository
{

	 public function getGoals()
    {
        return $this->createQueryBuilder('goals')
        ->orderBy('goals.title', 'ASC');
    }

}