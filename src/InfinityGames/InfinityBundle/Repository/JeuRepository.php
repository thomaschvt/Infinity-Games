<?php

namespace InfinityGames\InfinityBundle\Repository;

use Doctrine\ORM\EntityRepository;

class JeuRepository extends EntityRepository
{	
	public function FindOneLastGame(){
		
		return $this->createQueryBuilder('j')
		->orderBy('j.createdat', 'DESC')
		->setFirstResult(0)
		->setMaxResults(1)
		->getQuery()
		->getSingleResult();
		
	}
	
	public function findByBestNote(){
	
		return $this->createQueryBuilder('j')
		->orderBy('j.note', 'DESC')
		->setFirstResult(0)
		->setMaxResults(3)
		->getQuery()
		->getResult();
	
	}
	
	
}