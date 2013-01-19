<?php

namespace InfinityGames\InfinityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HeaderController extends Controller
{
    public function indexAction($dest)
    {
    	$repository = $this->getDoctrine()->getRepository('InfinityGamesInfinityBundle:MessageInterne');
    	
    	
    	
    	$query = $repository->createQueryBuilder('m')
    	->setParameters(array(
					    'dest' => $dest,
					    'statut'  => 'non-lu',
					))
    		->where('m.destinataire = :dest')
    		->andWhere('m.statut = :statut')
    		->orderBy('m.date', 'ASC')
    		->getQuery();
		$msg = $query->getResult();
		
		$nbrMsg = count($msg);
		
				
		return $this->render('InfinityGamesInfinityBundle:Header:affichage_nbr_msg_perso.html.twig', array(
				'msg' => $nbrMsg,
				));
    }
}
