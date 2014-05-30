<?php

namespace BOLD\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BOLDHomeBundle:Default:index.html.twig', array( "controller" => "home" ));
    }
}
