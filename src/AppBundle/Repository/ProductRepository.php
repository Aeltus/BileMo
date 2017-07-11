<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 08/07/17
 * Time: 19:52
 */
namespace AppBundle\Repository;

use AppBundle\Repository\AbstractRepository;

class ProductRepository extends AbstractRepository
{
    public function search($brand, $order = 'asc', $limit = 5, $page = 1)
    {
        $qb = $this
            ->createQueryBuilder('p')
            ->leftJoin('p.brand', 'b')
            ->orderBy('p.id', $order)
            ->where('p INSTANCE OF AppBundle\Entity\Product');

        if ($brand) {
            $qb
                ->andWhere('b.name = ?1')
                ->setParameter(1, $brand);
        }

        return $this->paginate($qb, $limit, $page);
    }
}
