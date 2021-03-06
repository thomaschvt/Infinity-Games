<?php

namespace InfinityGames\InfinityBundle\Controller;

use Symfony\Component\Validator\Constraints\Length;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use InfinityGames\InfinityBundle\Entity\Utilisateur;
use InfinityGames\InfinityBundle\Entity\MessageInterne;
use InfinityGames\InfinityBundle\Entity\MessageForum;
use InfinityGames\InfinityBundle\Entity\NiveauExperience;
use InfinityGames\InfinityBundle\Entity\LiaisonItemUser;
use InfinityGames\InfinityBundle\Entity\top_score_jeu;
use InfinityGames\InfinityBundle\Form\MessageInterneType;
use InfinityGames\InfinityBundle\Form\UtilisateurType;

/**
 * Utilisateur controller.
 *
 */
class UtilisateurController extends Controller
{
    /**
     * Lists all Utilisateur entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
		//liste des utilisateurs
        $entities = $em->getRepository('InfinityGamesInfinityBundle:Utilisateur')->findAll();   
        return $this->render('InfinityGamesInfinityBundle:Utilisateur:index.html.twig', array(
            'entities' => $entities,
        	
        ));
    }

    /**
     * Finds and displays a Utilisateur entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:Utilisateur')->find($id);
		
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Utilisateur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
	
        return $this->render('InfinityGamesInfinityBundle:Utilisateur:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }
    /**
     * Trouve l'utilisateur et renvoi les parametres de compte perso vers la page profil public
     *
     */
    public function affichageProfilAction($id){
    	//$utilisateurEntity = new Utilisateur();
    	$em = $this->getDoctrine()->getManager();
    	
    	//recupération des infos et des messages interne et forum
    	
    	//recupere les infos de compte
    	$utilisateurCourant = $this->get('security.context')->getToken()->getUser();
    	$utilisateurEntity = $em->getRepository('InfinityGamesInfinityBundle:Utilisateur')->find($id);
    	
    	//recupère les msg ou utilisateur est destinataire
    	$msgEntity =  $em->getRepository('InfinityGamesInfinityBundle:MessageInterne')->findAllMsgInterneByUser($utilisateurEntity);
    	
    	//recupère les msg de forum ou l'utilisateur est propriétaire
    	$msgForumEntity = $em->getRepository('InfinityGamesInfinityBundle:MessageForum')->findAllTopicByUser($utilisateurEntity);
    	
    	//recupère le niveau exprérience de l'utilisateur en rapport avec l'experience actuelle
    	$expActuelle  = $utilisateurEntity->getExperience();
    	$niveauExpEntity = $em->getRepository('InfinityGamesInfinityBundle:NiveauExperience')->findOneNiveau($expActuelle);
    	
    	//recupère les objets que l'utilisateurs a acheté
    	$itemLie = $em->getRepository('InfinityGamesInfinityBundle:LiaisonItemUser')->findLiaisonByUser($utilisateurEntity->getId());
    	
    	//recupère les topScores par jeu que l'utilisateur a réalisé
    	$topScoreByJeu = $em->getRepository('InfinityGamesInfinityBundle:TopScoreJeu')->findByUser($utilisateurEntity);
    	
    	//Creation du form d'envoi de message
    	$entityMsg = new MessageInterne();
    	$formMsg   = $this->createForm(new MessageInterneType(), $entityMsg);
    	
    	if (!$utilisateurEntity) {
    		throw $this->createNotFoundException('Aucun utilisateur ne correspond à cet identifiant.');
    	}   	
    	
    	return $this->render('InfinityGamesInfinityBundle:Utilisateur:profil_utilisateur.html.twig', array(
            'entity'      => $utilisateurEntity,
    		'msgInterne'  => $msgEntity,
    		'entityMsg' => $entityMsg,
    		'entityMsgForum' => $msgForumEntity,
    		'niveauExp' => $niveauExpEntity,
    		'xpActuelle' => $expActuelle,
    		'itemLie' => $itemLie,
    		'topScores' =>$topScoreByJeu,
    		'form'   => $formMsg->createView(),
    		));
    }
    
    /**
     * Displays a form to create a new Utilisateur entity.
     *
     */
    public function newAction()
    {
        $entity = new Utilisateur();
        $form   = $this->createForm(new UtilisateurType($entity), $entity);

        return $this->render('InfinityGamesInfinityBundle:Utilisateur:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Utilisateur entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Utilisateur();
        $form = $this->createForm(new UtilisateurType($entity), $entity);
        $form->bind($request);
		
        if ($form->isValid()) {
        	
        	//upload d'img
        	//on définit le dossier ou envoyer les images
        	$dir = "../web/image/img_user";
        	//on recupère le nom original du fichier
        	$nomBase = $form['avatarUrl']->getData()->getClientOriginalName();
        	//on découpe le nom du fichier pr recup l'extension
        	$extension=strrchr($nomBase,'.');
        	$extension=substr($extension,1) ;
        	//on génère le nouveau nom du fichier
        	$randNom = rand(0,1000000);
        	$dateNom = time();
        	$NewNom = 'img_'.$randNom.$dateNom.'.'.$extension;
        	//chemin a stocker pour récupère l'image
        	$pathImg = 'image/img_user/'.$NewNom;
        	//upload de l'image avec son nouveau nom
        	$form['avatarUrl']->getData()->move($dir, $NewNom);
        	
            $em = $this->getDoctrine()->getManager();
            $entity->setExperience(1);
            $entity->setNbrCreation(0);
            $entity->setAvatarUrl($pathImg);
            $entity->setCreatedAt(new \DateTime());
            $entity->setCredits(50);
            $entity->setRoles(array("ROLE_ADMIN"));
            $entity->setHighScore(0);
            $entity->setEnabled(1);
            $em->persist($entity);
            $em->flush();
			
            return $this->redirect($this->generateUrl('utilisateur_show', array('id' => $entity->getId())));
        }

        return $this->render('InfinityGamesInfinityBundle:Utilisateur:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Utilisateur entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:Utilisateur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Utilisateur entity.');
        }

        $editForm = $this->createForm(new UtilisateurType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:Utilisateur:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Utilisateur entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:Utilisateur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Utilisateur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new UtilisateurType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('utilisateur_edit', array('id' => $id)));
        }

        return $this->render('InfinityGamesInfinityBundle:Utilisateur:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Utilisateur entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('InfinityGamesInfinityBundle:Utilisateur')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Utilisateur entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('utilisateur'));
    }
	/**
	/**
	 * Fonction de suppression direct pour utilisateur accessible seulement via l'administration
	 * @param id d'un utilisateur
	 */
    public function deleteDirectUtilisateurAction($id){
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('InfinityGamesInfinityBundle:Utilisateur')->find($id);
    	
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find Utilisateur entity.');
    	}
    	
    	$em->remove($entity);
    	$em->flush();
    	return $this->redirect($this->generateUrl('utilisateur'));
    }
	
    /*public function changeRoleAction($id){
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('InfinityGamesInfinityBundle:Utilisateur')->find($id);
    	
    	if($entity->getRoles() == "ROLE_ADMIN"){
    		$entity->setRoles("ROLE_SUPER_ADMIN");
    	}else{
    		$entity->setRoles('ROLE_ADMIN');
    	}
    	
    	$em->persist($entity);
    	$em->flush();
    	
    	return $this->redirect($this->generateUrl('utilisateur'));
    }*/
    
   
       
    
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
