<?php

namespace InfinityGames\ConnexionBundle\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        //return $this->render('InfinityGamesConnexionBundle:Default:index.html.twig', array('name' => $name));
    	return new Response('<html><body>Hello '.$name.'!</body></html>');
    }
}
