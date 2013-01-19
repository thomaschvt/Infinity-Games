<?php

namespace InfinityGames\InfinityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use InfinityGames\InfinityBundle\Entity\TypeItemStore;
use InfinityGames\InfinityBundle\Form\TypeItemStoreType;

/**
 * TypeItemStore controller.
 *
 */
class TypeItemStoreController extends Controller
{
    /**
     * Lists all TypeItemStore entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('InfinityGamesInfinityBundle:TypeItemStore')->findAll();

        return $this->render('InfinityGamesInfinityBundle:TypeItemStore:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a TypeItemStore entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:TypeItemStore')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeItemStore entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $form   = $this->createForm(new TypeItemStoreType(), $entity);
        return $this->render('InfinityGamesInfinityBundle:TypeItemStore:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        	'add_form'   => $form->createView(),
            ));
    }

    /**
     * Displays a form to create a new TypeItemStore entity.
     *
     */
    public function newAction()
    {
        $entity = new TypeItemStore();
        $form   = $this->createForm(new TypeItemStoreType(), $entity);

        return $this->render('InfinityGamesInfinityBundle:TypeItemStore:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
	
    /**
     * function de creation d'une sous famille, doit recupèrer l'id du type parent
     */
    public function addSousFamilleAction($id, Request $request){
    	
    	$entity  = new TypeItemStore();
    	$form = $this->createForm(new TypeItemStoreType(), $entity);
    	$form->bind($request);
    	
    	if ($form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		//recupèration du type parent
    		$typeParent = $em->getRepository('InfinityGamesInfinityBundle:TypeItemStore')->find($id);
    		
    		$entity->setIdParent($typeParent);
    		
    		$em->persist($entity);
    		$em->flush();
    	
    		return $this->redirect($this->generateUrl('typeitemstore_show', array('id' => $entity->getId())));
    	}
    	
    	return $this->render('InfinityGamesInfinityBundle:TypeItemStore:new.html.twig', array(
    			'entity' => $entity,
    			'form'   => $form->createView(),
    	));
    }
    
    /**
     * Creates a new TypeItemStore entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new TypeItemStore();
        $form = $this->createForm(new TypeItemStoreType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
           
           
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('typeitemstore_show', array('id' => $entity->getId())));
        }

        return $this->render('InfinityGamesInfinityBundle:TypeItemStore:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TypeItemStore entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:TypeItemStore')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeItemStore entity.');
        }

        $editForm = $this->createForm(new TypeItemStoreType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:TypeItemStore:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing TypeItemStore entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:TypeItemStore')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeItemStore entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TypeItemStoreType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('typeitemstore_edit', array('id' => $id)));
        }

        return $this->render('InfinityGamesInfinityBundle:TypeItemStore:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TypeItemStore entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('InfinityGamesInfinityBundle:TypeItemStore')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TypeItemStore entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('typeitemstore'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
