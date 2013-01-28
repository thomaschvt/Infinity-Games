<?php

namespace InfinityGames\InfinityBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TopScoreJeuRepository extends EntityRepository
{	
		
	public function findByUser($user){
	
		//recupère tous les scores de l'utilisateur
		$scoresUser =  $this->createQueryBuilder('s')
		->setParameter('user', $user)
		->where('s.utilisateur = :user')
		->getQuery()
		->getResult();

		foreach($scoresUser as $line ) {
			
			$postion =  $this->createQueryBuilder('p')
			->setParameters(array('score' => $line->getScore(), 'jeu' => $line->getJeuRef()))
			->where('p.score > :score')
			->andWhere('p.jeu_ref = :jeu')
			->getQuery()
			->getResult();		
			$line->setPosition(count($postion)+1);				
		}
		
		return $scoresUser;
		
		
		
	}
	
}