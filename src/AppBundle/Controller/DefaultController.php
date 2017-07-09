<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;

class DefaultController extends Controller
{
    /**
     * @Rest\Get(
     *     path = "/articles",
     *     name = "app_articles_show"
     * )
     * @Rest\View(
     *     statusCode = 200
     * )
     */
    public function indexAction()
    {
        $articles = $this->getDoctrine()->getRepository('AppBundle:Product')->findAll();

        return $articles;
    }
}
