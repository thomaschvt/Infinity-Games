<?php

namespace InfinityGames\InfinityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdministrationController extends Controller
{
    public function indexAction()
    {
    	return $this->render('InfinityGamesInfinityBundle:Admin:index_admin.html.twig');
    }
}
