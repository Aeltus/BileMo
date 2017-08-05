<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 30/07/17
 * Time: 20:21
 */
namespace AppBundle\Model\Services;

use AppBundle\Entity\Product;
use ConsumerBundle\Entity\Consumer;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductChecker
{
    public function owner(Consumer $consumer, Product $product){
        $brands = $consumer->getBrands();
        $isOk = False;
        foreach ($brands as $brand){
            if ($brand->getName() == $product->getBrand()->getName()){
                $isOk = True;
            }
        }
        if (empty($brands)){
            return True;
        }
        if ($isOk === False){
            throw new NotFoundHttpException('Ce produit n\'existe pas.');
        }
    }
}
