<?php

namespace InfinityGames\InfinityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use InfinityGames\InfinityBundle\Entity\NiveauExperience;
use InfinityGames\InfinityBundle\Form\NiveauExperienceType;

/**
 * NiveauExperience controller.
 *
 */
class NiveauExperienceController extends Controller
{
    /**
     * Lists all NiveauExperience entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('InfinityGamesInfinityBundle:NiveauExperience')->findAll();

        return $this->render('InfinityGamesInfinityBundle:NiveauExperience:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a NiveauExperience entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:NiveauExperience')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NiveauExperience entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:NiveauExperience:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new NiveauExperience entity.
     *
     */
    public function newAction()
    {
        $entity = new NiveauExperience();
        $form   = $this->createForm(new NiveauExperienceType(), $entity);

        return $this->render('InfinityGamesInfinityBundle:NiveauExperience:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new NiveauExperience entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new NiveauExperience();
        $form = $this->createForm(new NiveauExperienceType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setStatut("actif");
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('niveauexperience_show', array('id' => $entity->getId())));
        }

        return $this->render('InfinityGamesInfinityBundle:NiveauExperience:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing NiveauExperience entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:NiveauExperience')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NiveauExperience entity.');
        }

        $editForm = $this->createForm(new NiveauExperienceType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:NiveauExperience:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing NiveauExperience entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:NiveauExperience')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NiveauExperience entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new NiveauExperienceType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('niveauexperience_edit', array('id' => $id)));
        }

        return $this->render('InfinityGamesInfinityBundle:NiveauExperience:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a NiveauExperience entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('InfinityGamesInfinityBundle:NiveauExperience')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find NiveauExperience entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('niveauexperience'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
