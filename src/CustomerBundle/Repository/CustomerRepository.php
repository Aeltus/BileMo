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
    public function search($mail, $order = 'asc', $limit = 5, $page = 1)
    {
        $qb = $this
            ->createQueryBuilder('c')
            ->orderBy('c.id', $order)
        ;

        if ($mail) {
            $qb
                ->Where('c.mail = ?1')
                ->setParameter(1, $mail);
        }

        return $this->paginate($qb, $limit, $page);
    }
}

