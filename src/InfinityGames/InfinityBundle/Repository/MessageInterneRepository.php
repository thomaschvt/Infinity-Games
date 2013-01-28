<?php

namespace InfinityGames\InfinityBundle\Repository;

use Doctrine\ORM\EntityRepository;

class MessageInterneRepository extends EntityRepository
{	
	
	public function findAllMsgInterneByUser($user){
		
		return $this->createQueryBuilder('m')
		->setParameter('dest', $user)
		->where('m.destinataire = :dest')
		->orderBy('m.date', 'DESC')
		->getQuery()
		->getResult();
	}
	
	public function findByUserAllMessage($user){
		
		return $this->createQueryBuilder('m')
		->setParameters(array(
				'dest' => $user,
				'statut'  => 'non-lu',
		))
		->where('m.destinataire = :dest')
		->andWhere('m.statut = :statut')
		->orderBy('m.date', 'ASC')
		->getQuery()
		->getResult();		
	}
	
}