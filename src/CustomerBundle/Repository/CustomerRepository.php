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
use CustomerBundle\Entity\Customer;

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
            ->andWhere('d.id = ?1')
            ->setParameter(1, $consumer->getId())
        ;

        if ($mail) {
            $qb
                ->andWhere('c.mail = ?3')
                ->setParameter(3, $mail);
        }

        return $this->paginate($qb, $limit, $page);
    }

    public function findOneFor(Customer $customer, Consumer $consumer)
    {
        $qb = $this
            ->createQueryBuilder('c')
            ->leftJoin('c.consumer', 'd')
            ->where('c.mail = ?0')
            ->setParameter(0, $customer->getMail())
            ->andWhere('d.id = ?1')
            ->setParameter(1, $consumer->getId())
            ;
        return $qb->getQuery()->getResult();
    }
}

