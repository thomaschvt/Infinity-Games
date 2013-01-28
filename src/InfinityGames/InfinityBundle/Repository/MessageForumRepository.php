<?php

namespace InfinityGames\InfinityBundle\Repository;

use Doctrine\ORM\EntityRepository;

class MessageForumRepository extends EntityRepository
{	
	//recupère les mesg liés à l'utilisateur
	
	public function findAllTopicByUser($id){
		
		return $this->createQueryBuilder('m')
		->setParameter('auteur', $id)
		->where('m.utilisateur = :auteur')
		->orderBy('m.luParAuteur', 'DESC')
		->orderBy('m.date', 'DESC')
		->getQuery()
		->getResult();
	}
	
	public function findLastTopics($limit = 5){
		
		return $this->createQueryBuilder('m')
		->setParameter('statut', 'En cours')
		->where('m.statut = :statut')
		->orderBy('m.date', 'ASC')
		->setMaxResults( 5 )
		->getQuery()
		->getResult();
	}
}