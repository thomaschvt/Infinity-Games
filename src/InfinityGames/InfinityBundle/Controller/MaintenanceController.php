<?php
namespace InfinityGames\InfinityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MaintenanceController extends controller {
	
	public function countUtilisateursAction(){
		$em = $this->getDoctrine()->getManager();
	
		$entities = $em->getRepository('InfinityGamesInfinityBundle:Utilisateur')->findAll();
		$rowcount = count($entities);
	
		$majStatsUtilsateurs = new StatsUtilisateur();
		$majStatsUtilsateurs->setDate(new \DateTime());
		$majStatsUtilsateurs->setNbrUtilisateurs($rowcount);
		$em->persist($majStatsUtilsateurs);
		$em->flush();
	
	
	}
}
