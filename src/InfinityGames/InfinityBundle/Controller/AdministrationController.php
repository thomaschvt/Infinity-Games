<?php

namespace InfinityGames\InfinityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use InfinityGames\InfinityBundle\Entity\StatsUtilisateur;

class AdministrationController extends Controller
{
    public function indexAction()
    {
    	return $this->render('InfinityGamesInfinityBundle:Administration:admin_index.html.twig');
    }    
}
