<?php


namespace InfinityGames\InfinityBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use InfinityGames\InfinityBundle\Entity\StatsUtilisateur;

class MaintenanceUsersStatsCommand extends ContainerAwareCommand {

	protected function configure()
	{
		$this
            ->setName('infinitygame:crontask:updateuserscount')
            ->setDescription('Compte le nombre d\'utilisateurs à date précise')
		;
	}

	
	protected function execute(InputInterface $input, OutputInterface $output)
	{	
		
		
		$entityManager = $this->getContainer()->get('doctrine')->getEntityManager();
		$entities = $entityManager->getRepository('InfinityGamesInfinityBundle:Utilisateur')->findAll();
		$rowcount = count($entities);
		
		$majStatsUtilsateurs = new StatsUtilisateur();
		$majStatsUtilsateurs->setDate(new \DateTime());
		$majStatsUtilsateurs->setNbrUtilisateurs($rowcount);
		$entityManager->persist($majStatsUtilsateurs);
		$entityManager->flush();
	}	
}
