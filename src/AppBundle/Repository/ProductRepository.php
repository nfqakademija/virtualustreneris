<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Category;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends \Doctrine\ORM\EntityRepository
{

	 public function findProductByCategory($id)
    {
        $qb = $this->createQueryBuilder('cat')
        ->where('cat.category = :id')
        ->setParameter('id', $id)
        ->getQuery()
        ->getResult();

        return $qb;
    }

}
