<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Category;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DishListsRepository extends \Doctrine\ORM\EntityRepository
{

    public function findPlanByCalories($rangeStart, $rangeEnd, $goals)
    {
        return $this->createQueryBuilder('plans')
            ->andWhere('plans.caloriesNum >= :rangeStart')
            ->setParameter('rangeStart', $rangeStart)
            ->andWhere('plans.caloriesNum <= :rangeEnd')
            ->setParameter('rangeEnd', $rangeEnd)
            ->andWhere('plans.goals = :goals')
            ->setParameter('goals', $goals)
            ->getQuery()
            ->getResult();
    }

    public function findPlanByMax()
    {
        return $this->createQueryBuilder('plans')
            ->andWhere('plans.caloriesNum = :rangeStart')
            ->setParameter('rangeStart', 2600)
            ->andWhere('plans.goals = :goals')
            ->setParameter('goals', 2)
            ->getQuery()
            ->getResult();
    }
}
