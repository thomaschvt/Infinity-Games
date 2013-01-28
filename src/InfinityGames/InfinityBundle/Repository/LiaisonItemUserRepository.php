<?php
namespace InfinityGames\InfinityBundle\Repository;

use Doctrine\ORM\EntityRepository;

class LiaisonItemUserRepository extends EntityRepository
{
	public function findLiaison($user, $item){

		return $this->createQueryBuilder('l')
		->setParameters(array(
		    'item' => $item,
		    'user'  => $user
		))
		->where('l.item = :item')
		->andWhere('l.utilisateur = :user')
		->getQuery()
		->getResult();
	}
	
	public function findLiaisonByUser($user){
	
		return $this->createQueryBuilder('l')
		->setParameter('user', $user)
		->where('l.utilisateur = :user')
		->getQuery()
		->getResult();
	}
}