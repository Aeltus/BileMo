<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ParticularProduct;
use AppBundle\Entity\Product;
use CustomerBundle\Entity\Customer;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Hateoas\Configuration\Route;
use Hateoas\Representation\Factory\PagerfantaFactory;
use Nelmio\ApiDocBundle\Annotation as Doc;

class DefaultController extends Controller
{
    /**
     * @Doc\ApiDoc(
     *     section="Articles",
     *     resource=true,
     *     description="Get the list of products, and linked products.",
     *     statusCodes={
     *          200="Returned when ok"
     *     },
     *     headers={
     *         {
     *             "name"="Authorization",
     *             "description"="Authorization key (obtained by OAuth2 authentication)",
     *             "required"="true"
     *         },
     *         {
     *             "name"="Accept",
     *             "description"="application/json;version=1.0",
     *             "required"="false"
     *         }
     *     }
     * )
     *
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
     *     name="page",
     *     requirements="\d+",
     *     default="1",
     *     description="The pagination offset"
     * )
     *
     * @Rest\View(
     *     statusCode = 200
     * )
     */
    public function indexAction($brand, $order, $limit, $page)
    {

        $consumer = $this->getDoctrine()->getRepository('ConsumerBundle:Consumer')->findOneById($this->get('security.token_storage')->getToken()->getUser()->getId());
        $brands = $consumer->getBrands();

        $pager = $this->getDoctrine()->getRepository('AppBundle:Product')->search(
            ucfirst($brand),
            $order,
            $limit,
            $page,
            $brands
        );

        $pagerfantaFactory   = new PagerfantaFactory();
        $paginatedCollection = $pagerfantaFactory->createRepresentation(
            $pager,
            new Route('app_articles_show', array(), true)
        );

        return $paginatedCollection;
    }

    /**
     * @Doc\ApiDoc(
     *     section="Articles",
     *     resource=true,
     *     description="Get just one product identified by {id}.",
     *     statusCodes={
     *          200="Returned when ok",
     *          404="Returned when the product is not found"
     *     },
     *     requirements={
     *         {
     *             "name"="id",
     *             "dataType"="integer",
     *             "requirement"="\d+",
     *             "description"="The article unique identifier."
     *         }
     *     },
     *     headers={
     *         {
     *             "name"="Authorization",
     *             "description"="Authorization key (obtained by OAuth2 authentication)",
     *             "required"="true"
     *         },
     *         {
     *             "name"="Accept",
     *             "description"="application/json;version=1.0",
     *             "required"="false"
     *         }
     *     }
     * )
     *
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
            throw new NotFoundHttpException('Ce produit est introuvable.');
        }
        $addressChecker = $this->container->get('product_checker');
        $addressChecker->Owner($this->getDoctrine()->getRepository('ConsumerBundle:Consumer')->findOneById($this->get('security.token_storage')->getToken()->getUser()->getId()), $product);

        return $product;
    }

    /**
     * @Doc\ApiDoc(
     *     section="Articles",
     *     resource=true,
     *     description="Get just one product in details identified by {id}.",
     *     statusCodes={
     *          200="Returned when ok",
     *          404="Returned when the product is not found"
     *     },
     *     requirements={
     *         {
     *             "name"="id",
     *             "dataType"="integer",
     *             "requirement"="\d+",
     *             "description"="The article unique identifier."
     *         }
     *     },
     *     headers={
     *         {
     *             "name"="Authorization",
     *             "description"="Authorization key (obtained by OAuth2 authentication)",
     *             "required"="true"
     *         },
     *         {
     *             "name"="Accept",
     *             "description"="application/json;version=1.0",
     *             "required"="false"
     *         }
     *     }
     * )
     *
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
        $addressChecker = $this->container->get('product_checker');
        $addressChecker->Owner($this->getDoctrine()->getRepository('ConsumerBundle:Consumer')->findOneById($this->get('security.token_storage')->getToken()->getUser()->getId()), $particularProduct);
        if($particularProduct instanceof ParticularProduct){
            return $particularProduct;
        }
        throw new NotFoundHttpException('Ce produit est introuvable.');
    }

}
