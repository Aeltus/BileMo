<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 14/07/17
 * Time: 17:21
 */
namespace CustomerBundle\Repository;

use AppBundle\Repository\AbstractRepository;

class CustomerRepository extends AbstractRepository
{
    public function search($mail, $order = 'asc', $limit = 5, $page = 1, $isAvailable = TRUE)
    {
        $qb = $this
            ->createQueryBuilder('c')
            ->orderBy('c.id', $order)
            ->where('c.isAvailable = ?2')
            ->setParameter(2, $isAvailable)
        ;

        if ($mail) {
            $qb
                ->AndWhere('c.mail = ?1')
                ->setParameter(1, $mail);
        }

        return $this->paginate($qb, $limit, $page);
    }
}

