<?php

namespace InfinityGames\InfinityBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TypeItemStoreRepository extends EntityRepository
{	
	public function findAllParentType(){
		
		return $this->createQueryBuilder('t')
    	->where('t.id_parent IS NULL')
    	->getQuery()
    	->getResult();
		
	}
	
	public function findAllSsType(){
		
		return  $this->createQueryBuilder('t')
    	->where('t.id_parent IS NOT NULL')
    	->getQuery()
    	->getResult();
	}
}