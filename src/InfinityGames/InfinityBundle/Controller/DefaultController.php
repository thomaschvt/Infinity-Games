<?php

namespace InfinityGames\InfinityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use InfinityGames\InfinityBundle\Entity\Jeu;

class DefaultController extends Controller
{
	/**
	 * Fonction de la page d'accueil. Recupère les infos a affichés sur cette page et les transmet à la vue
	 */
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	
    	$entitiesJeu = $em->getRepository('InfinityGamesInfinityBundle:Jeu')->findBy(array('statut' => 'actif'),null ,3, null);
    	
    	return $this->render('InfinityGamesInfinityBundle:Accueil:accueil.html.twig', array(
    			'entities' => $entitiesJeu,
    	));	
    }
}
