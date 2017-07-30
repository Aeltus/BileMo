<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 09/07/2017
 * Time: 09:54
 */
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class AbstractRepository extends EntityRepository
{
    protected function paginate(QueryBuilder $qb, $limit = 5, $page = 1)
    {
        if (0 == $limit) {
            throw new \LogicException('limit must be greater than 0.');
        }

        $pager = new Pagerfanta(new DoctrineORMAdapter($qb));

        $currentPage = $page;
        $pager->setCurrentPage($currentPage);
        $pager->setMaxPerPage((int) $limit);

        if ($pager->getNbResults() < 1)
        {
            throw new NotFoundHttpException('Votre recherche n\'a pu aboutir.');
        }

        return $pager;
    }
}
