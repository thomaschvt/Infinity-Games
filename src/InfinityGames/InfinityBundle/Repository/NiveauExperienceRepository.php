<?php

namespace InfinityGames\InfinityBundle\Repository;

use Doctrine\ORM\EntityRepository;

class NiveauExperienceRepository extends EntityRepository
{
	public function findAllOrderedByName()
	{
		return $this->getEntityManager()
		->createQuery('SELECT p FROM AcmeStoreBundle:Product p ORDER BY p.name ASC')
		->getResult();
	}
		
	public function findOneNiveau($exp){
		
		return $this->createQueryBuilder('n')
		->setParameter('exp', $exp)
		->where('n.limiteHaute > :exp')
		->andWhere('n.limiteBasse < :exp')
		->orderBy('n.intitule', 'DESC')
		->getQuery()
		->getSingleResult();
	}
}