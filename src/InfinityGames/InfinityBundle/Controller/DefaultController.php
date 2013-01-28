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
    	    	
    	//recupération des derniers message
    	$msgForumEntities = $em->getRepository('InfinityGamesInfinityBundle:MessageForum')->findLastTopics();
    	 
    	//recupération TOP 5  	
		$highScores = $em->getRepository('InfinityGamesInfinityBundle:Utilisateur')->findByHighScore();
    	
    	//recupération du dernier jeu
    	$repositoryJeu = $this->getDoctrine()->getRepository('InfinityGamesInfinityBundle:Jeu');
    	
    	//recupération du dernier jeu ajouter
    	$dernierJeu = $em->getRepository('InfinityGamesInfinityBundle:Jeu')->FindOneLastGame();
    	
    	return $this->render('InfinityGamesInfinityBundle:Accueil:accueil.html.twig', array(
    			
    			'forumEntities' => $msgForumEntities,
    			'highScoreEntities'=> $highScores,
    			'dernierJeu' => $dernierJeu,
    	));	
    }
}
