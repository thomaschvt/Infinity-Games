<?php

namespace InfinityGames\InscriptionBundle\Controller;
use Doctrine\Common\Annotations\Annotation\Required;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use InfinityGames\InscriptionBundle\Entity\Utilisateur;

class DefaultController extends Controller
{
	//fonction d'inscription
    public function indexAction()
    {
    	// On crée un objet 
    	$utilisateur = new Utilisateur();
    	
    	//champ prédéfinis
    	$utilisateur->setHighScore(0);
    	$utilisateur->setNbrCreation(0);
    	$utilisateur->setCredits(0);
    	$utilisateur->setStatutDevelopper(0);
    	$utilisateur->setStatut(0);
    	$utilisateur->setCreatedAt(new \DateTime());
    	
    	// On crée le FormBuilder grâce à la méthode du contrôleur.
    	 $form = $this->createFormBuilder($utilisateur)
        ->add('nom',    'text', array('label'=>'Votre nom'))
        ->add('prenom',  'text', array('label'=>'Votre Prénom'))
        ->add('pseudo',  'text', array('label'=>'Votre nom en jeu'))
        ->add('Avatar', 'file', array('label'=>'Votre Avatar'))
        ->add('email',  'email', array('label'=>'Votre E-mail'))
        ->add('mdp',   'password', array('label'=>'Votre mot de passe'))
        ->add('site',   'text', array('label'=>'Votre site personnel', "required"=>false))
        ->getForm();
    	
    	 
    // On récupère la requête.
    $request = $this->get('request');
    

    // On vérifie qu'elle est de type « POST ».
    if( $request->getMethod() == 'POST' )
    {
        // On fait le lien Requête <-> Formulaire.
        $form->bindRequest($request);

        // On vérifie que les valeurs rentrées sont correctes.
        if( $form->isValid() )
        {
        	//on verifie que l'utilisateur ne soit pas deja inscrit
        	$email_verif = $utilisateur->getEmail();
        	//autoriser le champ site comme null
        	$site_verif = $utilisateur->getSite();
        	if(!$site_verif){
        		$utilisateur->setSite(" ");
        	}
	        $emVerif = $this->getDoctrine()->getEntityManager();
			$utilisateur_old = $emVerif->getRepository('InfinityGamesInscriptionBundle:Utilisateur')->findOneByEmail($email_verif);
			if ($utilisateur_old)
			{
				return $this->render('InfinityGamesInscriptionBundle:incription:resultat_inscription.html.twig', array(
        'resultat' => 'fail', 'nom'=>'', 'prenom'=>'', 'mail'=> $utilisateur->getEmail()));
			}
        
        	
            // On l'enregistre notre objet dans la base de données.
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($utilisateur);
            $em->flush();

            //Si c'est ok on envoi le mail de confirm et redirige 
           
           
           return $this->render('InfinityGamesInscriptionBundle:incription:resultat_inscription.html.twig', array(
        'resultat' => 'succes', 'nom' => $utilisateur->getNom(), 'prenom' => $utilisateur->getPrenom(), 'mail'=> $utilisateur->getEmail()));
        }
    }
    	//inscription
        return $this->render('InfinityGamesInscriptionBundle:incription:inscription.html.twig', array(
        'form' => $form->createView()));
    }
    public function envoiMailConfirm(){
    	// send an email to the affiliate
    	$message = $this->getMailer()
    	->composeAndSend(
  			'infinitygames@infinity.com',
  			'thomascgvt@gmail.com',
  			'Subject',
  			'Body'
			);
    	return $message;
    }
    
}
