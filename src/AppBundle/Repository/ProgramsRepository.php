<?php

namespace AppBundle\Repository;

/**
 * ProgramsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProgramsRepository extends \Doctrine\ORM\EntityRepository
{

    public function findSportPlan($gender, $experience, $goals, $ageCategory)
    {
        return $this->createQueryBuilder('plans')
            ->andWhere('plans.gender= :gender')
            ->setParameter('gender', $gender)
            ->andWhere('plans.experience = :experience')
            ->setParameter('experience', $experience)
            ->andWhere('plans.goals = :goals')
            ->setParameter('goals', $goals)
            ->andWhere('plans.ageCategory = :ageCategory')
            ->setParameter('ageCategory', $ageCategory)
            ->getQuery()
            ->getResult();
    }

    public function findBackPlan()
    {
        return $this->createQueryBuilder('plans')
            ->andWhere('plans.id= :id')
            ->setParameter('id', 50)
            ->getQuery()
            ->getResult();
    }
}
