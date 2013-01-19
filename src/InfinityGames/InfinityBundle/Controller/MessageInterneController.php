<?php

namespace InfinityGames\InfinityBundle\Controller;

use InfinityGames\InfinityBundle\Entity\Utilisateur;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use InfinityGames\InfinityBundle\Entity\MessageInterne;
use InfinityGames\InfinityBundle\Form\MessageInterneType;

/**
 * MessageInterne controller.
 *
 */
class MessageInterneController extends Controller
{
    /**
     * Lists all MessageInterne entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('InfinityGamesInfinityBundle:MessageInterne')->findAll();

        return $this->render('InfinityGamesInfinityBundle:MessageInterne:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a MessageInterne entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:MessageInterne')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MessageInterne entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:MessageInterne:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new MessageInterne entity.
     *
     */
    public function newAction()
    {
        $entity = new MessageInterne();
        $form   = $this->createForm(new MessageInterneType(), $entity);

        return $this->render('InfinityGamesInfinityBundle:MessageInterne:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new MessageInterne entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new MessageInterne();
        $utilisateurEntity = new Utilisateur();
        $form = $this->createForm(new MessageInterneType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setDate(new \DateTime());
            
            //on recupère l'id de l'expediteur pour renvoyer vers le bon profil
            $em->persist($entity);
            $utilisateurCourant = $this->get('security.context')->getToken()->getUser();
            $utilisateurEntity = $em->getRepository('InfinityGamesInfinityBundle:Utilisateur')->find($utilisateurCourant);                        
            $entity->setExpediteur($utilisateurEntity);
            $entity->setStatut("non-lu");
            $em->flush();
			
            $this->get('session')->getFlashBag()->add('notice', 'Votre message a bien été envoyé.');
            
            //on redirige vers le profil qui correspond à l'expediteur           
            return $this->redirect($this->generateUrl('utilisateur_profil', array('id' => $utilisateurEntity->getId())));
        }

        return $this->render('InfinityGamesInfinityBundle:MessageInterne:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing MessageInterne entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:MessageInterne')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MessageInterne entity.');
        }

        $editForm = $this->createForm(new MessageInterneType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:MessageInterne:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing MessageInterne entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:MessageInterne')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MessageInterne entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new MessageInterneType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('messageinterne_edit', array('id' => $id)));
        }

        return $this->render('InfinityGamesInfinityBundle:MessageInterne:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a MessageInterne entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('InfinityGamesInfinityBundle:MessageInterne')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find MessageInterne entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('messageinterne'));
    }
    public function deleteAllForUserAction($id){
    	$em = $this->getDoctrine()->getManager();
    	$msgEntity = $em->getRepository('InfinityGamesInfinityBundle:MessageInterne')->findBydestinataire($id);
    	foreach ($msgEntity as $msg){
    		$em->remove($msg);
    		$em->flush();
    	}
    	 return $this->redirect($this->generateUrl('utilisateur_profil', array('id' => $id)));
    	 
    }
    
    public function readAction($id){
    	//on recupère le msg interne concerné
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('InfinityGamesInfinityBundle:MessageInterne')->find($id);
    	//on met a jour le statut
    	$entity->setStatut("lu");
    	//on crée le form de suppression et de reponse
    	$deleteForm = $this->createDeleteForm($id);
    	$form   = $this->createForm(new MessageInterneType(), $entity);
    	
    	//on met a jour en bdd
    	$em->persist($entity);
    	$em->flush();
    	
    	return $this->render('InfinityGamesInfinityBundle:MessageInterne:read.html.twig', array(
    			'entity'      => $entity,
    			'delete_form' => $deleteForm->createView(),
    			'repForm' =>$form->createView(),
    	));
    }
    
    public function deleteOneAction($id){
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('InfinityGamesInfinityBundle:MessageInterne')->find($id);
    	$userEntity = $entity->getExpediteur()->getId();
    	
    	$em->remove($entity);
    	$em->flush();
    	
    	return $this->redirect($this->generateUrl('utilisateur_profil', array('id' => $userEntity)));
    }
    
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
