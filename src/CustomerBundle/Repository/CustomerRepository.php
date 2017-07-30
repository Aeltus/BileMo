<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 14/07/17
 * Time: 17:21
 */
namespace CustomerBundle\Repository;

use AppBundle\Repository\AbstractRepository;
use ConsumerBundle\Entity\Consumer;

class CustomerRepository extends AbstractRepository
{
    public function search($mail, $order = 'asc', $limit = 5, $page = 1, $isAvailable = TRUE, Consumer $consumer)
    {
        $qb = $this
            ->createQueryBuilder('c')
            ->leftJoin('c.consumer', 'd')
            ->orderBy('c.id', $order)
            ->where('c.isAvailable = ?0')
            ->setParameter(0, $isAvailable)
        ;

        if ($id !== NULL){
            $qb
                ->andWhere('c.id = ?2')
                ->setParameter(2,(int) $id);
        }

        if ($mail) {
            $qb
                ->andWhere('c.mail = ?3')
                ->setParameter(3, $mail);
        }

        return $this->paginate($qb, $limit, $page);
    }
}

