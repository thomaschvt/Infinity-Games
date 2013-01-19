<?php

namespace InfinityGames\InfinityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use InfinityGames\InfinityBundle\Entity\Jeu;
use InfinityGames\InfinityBundle\Entity\MessageForum;	

class DefaultController extends Controller
{
	/**
	 * Fonction de la page d'accueil. Recupère les infos a affichés sur cette page et les transmet à la vue
	 */
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	
    	$entitiesJeu = $em->getRepository('InfinityGamesInfinityBundle:Jeu')->findBy(array('statut' => 'actif'),null ,3, null);
    	
    	$repository = $this->getDoctrine()->getRepository('InfinityGamesInfinityBundle:MessageForum');
    	$query = $repository->createQueryBuilder('m')
    	->setParameter('statut', 'En cours')
    	->where('m.statut = :statut')
    	->orderBy('m.date', 'ASC')
    	->setMaxResults( 5 )
    	->getQuery();
    	
    	$msgForumEntities = $query->getResult();
    	
    	return $this->render('InfinityGamesInfinityBundle:Accueil:accueil.html.twig', array(
    			'entities' => $entitiesJeu,
    			'forumEntities' => $msgForumEntities,
    	));	
    }
}
