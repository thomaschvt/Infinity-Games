<?php

namespace InfinityGames\InfinityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use InfinityGames\InfinityBundle\Entity\NiveauCreation;
use InfinityGames\InfinityBundle\Form\NiveauCreationType;

/**
 * NiveauCreation controller.
 *
 */
class NiveauCreationController extends Controller
{
    /**
     * Lists all NiveauCreation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('InfinityGamesInfinityBundle:NiveauCreation')->findAll();

        return $this->render('InfinityGamesInfinityBundle:NiveauCreation:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a NiveauCreation entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:NiveauCreation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NiveauCreation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:NiveauCreation:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new NiveauCreation entity.
     *
     */
    public function newAction()
    {
        $entity = new NiveauCreation();
        $form   = $this->createForm(new NiveauCreationType(), $entity);

        return $this->render('InfinityGamesInfinityBundle:NiveauCreation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new NiveauCreation entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new NiveauCreation();
        $form = $this->createForm(new NiveauCreationType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('niveaucreation_show', array('id' => $entity->getId())));
        }

        return $this->render('InfinityGamesInfinityBundle:NiveauCreation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing NiveauCreation entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:NiveauCreation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NiveauCreation entity.');
        }

        $editForm = $this->createForm(new NiveauCreationType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:NiveauCreation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing NiveauCreation entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:NiveauCreation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NiveauCreation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new NiveauCreationType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('niveaucreation_edit', array('id' => $id)));
        }

        return $this->render('InfinityGamesInfinityBundle:NiveauCreation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a NiveauCreation entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('InfinityGamesInfinityBundle:NiveauCreation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find NiveauCreation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('niveaucreation'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
