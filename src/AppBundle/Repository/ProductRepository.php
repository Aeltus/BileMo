<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 08/07/17
 * Time: 19:52
 */
namespace AppBundle\Repository;

use AppBundle\Repository\AbstractRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductRepository extends AbstractRepository
{
    public function search($brand, $order = 'asc', $limit = 5, $page = 1, $brands, $isAvailable, \DateTime $availability = NULL)
    {
        $brandsNames = [];

        $qb = $this
            ->createQueryBuilder('p')
            ->leftJoin('p.brand', 'b')
            ->orderBy('p.id', $order)
            ->where('p INSTANCE OF AppBundle\Entity\Product')
            ->andWhere('p.isAvailable = ?2')
            ->setParameter(2, $isAvailable)
        ;

        if ($availability !== NULL)
        {
            $qb
                ->andWhere('p.availabilityDate < ?0')
                ->setParameter(0, $availability->format('Y-m-d H:i:s'))
                ;
        }

        if($brands !== NULL){
            foreach ($brands as $currentBrand){
                $brandsNames[] = $currentBrand->getName();
            }
        }

        if (($brand !== '' && in_array($brand, $brandsNames)) || (count($brands[0]) < 1 && $brand !== '')) {
            $qb
                ->andWhere('b.name = ?1')
                ->setParameter(1, $brand)
            ;
        } elseif ($brand == '' && count($brands[0]) > 0){
            $i=2;
            foreach ($brands as $currentBrand){
                $i++;
                if ($i == 3){
                    $qb
                        ->andWhere('b.name = ?'.$i)
                    ;
                } else {
                    $qb
                        ->orWhere('b.name = ?'.$i)
                    ;
                }
                $qb
                    ->setParameter($i, $currentBrand->getName())
                ;

            }
        } elseif ($brand !== '' && !in_array($brand, $brandsNames)){
            throw new NotFoundHttpException('Ce produit est introuvable.');
        }
        return $this->paginate($qb, $limit, $page);
    }
}
