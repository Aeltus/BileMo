<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ParticularProduct;
use AppBundle\Entity\Product;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Representation\Products;
use AppBundle\Representation\ParticularProducts;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    /**
     * @Rest\Get(
     *     path = "/articles",
     *     name = "app_articles_show"
     * )
     * @Rest\QueryParam(
     *     name="brand",
     *     requirements="\w+",
     *     nullable=true,
     *     description="The brand to search for"
     * )
     * @Rest\QueryParam(
     *     name="order",
     *     requirements="asc|desc",
     *     default="asc",
     *     description="Sort order (asc or desc)"
     * )
     * @Rest\QueryParam(
     *     name="limit",
     *     requirements="\d+",
     *     default="10",
     *     description="Max number of products per page."
     * )
     * @Rest\QueryParam(
     *     name="offset",
     *     requirements="\d+",
     *     default="0",
     *     description="The pagination offset"
     * )
     * @Rest\View(
     *     statusCode = 200
     * )
     */
    public function indexAction($brand, $order, $limit, $offset)
    {
        $pager = $this->getDoctrine()->getRepository('AppBundle:Product')->search(
            $brand,
            $order,
            $limit,
            $offset
        );

        return new Products($pager);
    }

    /**
     * @Rest\Get(
     *     path = "/articles/{id}",
     *     name = "app_articles_show_one"
     * )
     * @Rest\View(
     *     statusCode = 200
     * )
     */
    public function productAction(Product $product)
    {
        if($product instanceof ParticularProduct){
            throw new NotFoundHttpException('This product was not found.');
        }
        return $product;
    }

    /**
     * @Rest\Get(
     *     path = "/articles/details/{id}",
     *     name = "app_detailed_articles_show_one"
     * )
     * @Rest\View(
     *     statusCode = 200
     * )
     */
    public function productDetailsAction(ParticularProduct $particularProduct)
    {
        if($particularProduct instanceof ParticularProduct){
            return $particularProduct;
        }
        throw new NotFoundHttpException('This particular product was not found.');
    }
}
