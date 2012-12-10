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
        $em = $this->getDoctrine()->getManager();

        $utilisateurs = $em->getRepository('InfinityGamesInfinityBundle:Utilisateur')->findAll();

        return $this->render('InfinityGamesInfinityBundle:Classement:OverallClassement.html.twig', array(
            'utilisateursArray' => $utilisateurs,
        ));
    }

}
