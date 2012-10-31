<?php

namespace InfinityGames\ProfilUtilisateurBundle\Controller;

use InfinityGames\ProfilUtilisateurBundle\Entity\MessageInterne;

use InfinityGames\InscriptionBundle\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($userId)
    {
/////////On recup les infos user///////////////////////////////////////////////////////////////////////////////////////////////////
		$utilisateur = $this->recupInfoAction($userId);
    	
///////// On crée l'objet form pour envoi de nouveaux messages/////////////////////////////////////////////////////////////////////		
    	$form_nvx = $this->creaFormAction($userId);
    	
///////// On renvoi les infos vers la vue////////////////////////////////////////////////////////////////////	
        return $this->render('InfinityGamesProfilUtilisateurBundle:Profil:profil.html.twig', array('utilisateur'=>$utilisateur, 'form' => $form_nvx->createView()));
    }
    
    public function recupInfoAction($userId){
    	$utilisateur = new Utilisateur();
    	//récupération de l' utilisateur ciblé
    	$utilisateurRepository = $this->getDoctrine()->getRepository('InfinityGamesInscriptionBundle:Utilisateur');
    	$utilisateur = $utilisateurRepository->find($userId);
    	
    	return $utilisateur;
    }
    public function creaFormAction($userId){
    	
    	$msg = new MessageInterne();
    	//champ prédéfinis
    	$msg->setCreatedAt(new \DateTime());
    	$msg->setExpediteur($userId);
    	// On crée le FormBuilder
    	$form = $this->createFormBuilder($msg)
    	->add('destinataire',    'text', array('label'=>'Destinataire'))
    	->add('titremessage',    'text', array('label'=>'Titre'))
    	->add('contenumsg',    'textarea', array('label'=>'Contenu'))
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
    			//on créer un objet utilisateur
    			$destinataire = new Utilisateur();
    			//on recup le pseudo mis ds le form
    			$dest_verif = $msg->getDestinataire();
    			//on va chercher l'utilisateur qui correspond au pseudo
    			
    			$emDest = $this->getDoctrine()->getEntityManager();
				$destinataire = $emDest->getRepository('InfinityGamesInscriptionBundle:Utilisateur')->findOneByPseudo($dest_verif);
				if($destinataire){
					$msg->setDestinataire($destinataire);
				}
				
				 		
    		    // On l'enregistre notre objet dans la base de données.
    			$em = $this->getDoctrine()->getEntityManager();
    			$em->persist($msg);
    			$em->flush();	
    		}
    	}
    	return $form;
    }
}
