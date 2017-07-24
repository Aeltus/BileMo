<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 23/07/17
 * Time: 22:52
 */
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DocController extends Controller
{
    /**
     * @Route("/api/doc", name="documentation_index")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Doc:index.html.twig');
    }
}
