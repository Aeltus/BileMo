<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 09/07/2017
 * Time: 21:03
 */
namespace AppBundle\Repository;

use AppBundle\Repository\AbstractRepository;

class ParticularProductRepository extends AbstractRepository
{
    public function search($brand, $order = 'asc', $limit = 5, $offset = 0)
    {
        $qb = $this
            ->createQueryBuilder('p')
            ->leftJoin('p.brand', 'b')
            ->orderBy('p.id', $order)
            ->where('p INSTANCE OF AppBundle\Entity\ParticularProduct');

        if ($brand) {
            $qb
                ->andWhere('b.name = ?1')
                ->setParameter(1, $brand);
        }

        return $this->paginate($qb, $limit, $offset);
    }
}

