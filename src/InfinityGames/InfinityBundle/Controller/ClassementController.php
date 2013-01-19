<?php

namespace InfinityGames\InfinityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use InfinityGames\InfinityBundle\Entity\Utilisateur;


/**
 * Classement controller.
 *
 */
class ClassementController extends Controller
{
    /**
     * Fonction sui recupère tout les utilisateurs pour les renvoyers vers le classement.
    */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('InfinityGamesInfinityBundle:Utilisateur');
    	$query = $repository->createQueryBuilder('u')
    	->orderBy('u.highScore', 'DESC')
    	->getQuery();
    	$utilisateurs = $query->getResult();
           
        return $this->render('InfinityGamesInfinityBundle:Classement:OverallClassement.html.twig', array(
            'utilisateursArray' => $utilisateurs,
        	
        ));
    }

}
