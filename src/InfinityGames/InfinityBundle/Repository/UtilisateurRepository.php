<?php

namespace InfinityGames\InfinityBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UtilisateurRepository extends EntityRepository
{	
	/*
	 * recupère les meilleurs scores. Limit manipulable
	 */
	public function findByHighScore($limit=5){
		
		return $this->createQueryBuilder('u')
		->orderBy('u.highScore', 'DESC')
		->setMaxResults(5)
		->getQuery()
		->getResult(); 
	}
	
	public function findOneNameAdmin(){
	
		return $this->createQueryBuilder('u')
		->setParameter('name', 'admin')
		->where('u.username = :name')
		->getQuery()
		->getSingleResult();
	}
}