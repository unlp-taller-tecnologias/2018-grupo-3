<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Model\UserManagerInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        $em =   $this->getDoctrine()->getManager();
        $noticias = $em->getRepository('AppBundle:Noticia')->noticiasActuales();
        $catedras = $em->getRepository('AppBundle:Catedra')->findAll();
        return $this->render('default/index.html.twig', array(
            'noticias' => $noticias,
            'catedras' => $catedras ));
    }
}
