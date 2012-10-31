<?php

namespace InfinityGames\AccueilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('InfinityGamesAccueilBundle:Index:index.html.twig');
        
    }
}
