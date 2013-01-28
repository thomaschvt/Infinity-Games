<?php

namespace InfinityGames\InfinityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HeaderController extends Controller
{
    public function indexAction($dest)
    {   
    	$em = $this->getDoctrine()->getManager();
    	
    	$msg = $em->getRepository('InfinityGamesInfinityBundle:MessageInterne')->findByUserAllMessage($dest);
    	$nbrMsg = count($msg);	
		return $this->render('InfinityGamesInfinityBundle:Header:affichage_nbr_msg_perso.html.twig', array(
				'msg' => $nbrMsg,
				));
    }
}
