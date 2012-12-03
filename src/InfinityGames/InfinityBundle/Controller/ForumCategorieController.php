<?php

namespace InfinityGames\InfinityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use InfinityGames\InfinityBundle\Entity\ForumCategorie;
use InfinityGames\InfinityBundle\Entity\MessageForum;
use InfinityGames\InfinityBundle\Form\ForumCategorieType;
use InfinityGames\InfinityBundle\Form\MessageForumType;

/**
 * ForumCategorie controller.
 *
 */
class ForumCategorieController extends Controller
{
    /**
     * Lists all ForumCategorie entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('InfinityGamesInfinityBundle:ForumCategorie')->findAll();

        return $this->render('InfinityGamesInfinityBundle:ForumCategorie:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    /**
     * Function de gestion de l'index du forum public
     */
   public function indexForumPublicAction(){
   	//recupération des categorie du forum
	   	$em = $this->getDoctrine()->getManager();
	   	$categorieEntities = $em->getRepository('InfinityGamesInfinityBundle:ForumCategorie')->findAll();
	
	//recupération des topics des différentes categories
		$topicStatut = null;
	   	$topicEntities = $em->getRepository('InfinityGamesInfinityBundle:MessageForum')->findByidParent($topicStatut);
	   	
	//creation du form d'ajout de topic
	   $entityTopic = new MessageForum();
       $formTopic   = $this->createForm(new MessageForumType(), $entityTopic);
	   	
	   	return $this->render('InfinityGamesInfinityBundle:ForumPublic:forum.html.twig', array(
	   			'categorieEntities' => $categorieEntities,
	   			'topicEntities' => $topicEntities,
	   			'form' => $formTopic->createView(),
	   	));
   }

    /**
     * Finds and displays a ForumCategorie entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:ForumCategorie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ForumCategorie entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:ForumCategorie:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new ForumCategorie entity.
     *
     */
    public function newAction()
    {
        $entity = new ForumCategorie();
        $form   = $this->createForm(new ForumCategorieType(), $entity);

        return $this->render('InfinityGamesInfinityBundle:ForumCategorie:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new ForumCategorie entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new ForumCategorie();
        $form = $this->createForm(new ForumCategorieType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('forumcategorie_show', array('id' => $entity->getId())));
        }

        return $this->render('InfinityGamesInfinityBundle:ForumCategorie:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ForumCategorie entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:ForumCategorie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ForumCategorie entity.');
        }

        $editForm = $this->createForm(new ForumCategorieType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:ForumCategorie:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing ForumCategorie entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:ForumCategorie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ForumCategorie entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ForumCategorieType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('forumcategorie_edit', array('id' => $id)));
        }

        return $this->render('InfinityGamesInfinityBundle:ForumCategorie:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ForumCategorie entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('InfinityGamesInfinityBundle:ForumCategorie')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ForumCategorie entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('forumcategorie'));
    }
	/**
	/**
	 * @param id d'une categorie de forum
	 * suppression direct d'une categorie du forum - accessible seulement via l'admin
	 * 
	 */
    public function deleteDirectAction($id){
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('InfinityGamesInfinityBundle:ForumCategorie')->find($id);
    	$em->remove($entity);
    	$em->flush();
    	   	
    	return $this->redirect($this->generateUrl('forumcategorie'));
    }
	

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
