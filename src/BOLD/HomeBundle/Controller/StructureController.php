<?php

namespace BOLD\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class StructureController extends Controller
{
  function indexAction(Request $request)
  {
     return $this->render('BOLDHomeBundle:Structure:index.html.twig', array( "controller" => "structure", ));
  }
}
