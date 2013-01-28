<?php

namespace InfinityGames\InfinityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use InfinityGames\InfinityBundle\Entity\LiaisonItemUser;
use InfinityGames\InfinityBundle\Form\LiaisonItemUserType;

/**
 * LiaisonItemUser controller.
 *
 */
class LiaisonItemUserController extends Controller
{
    /**
     * Lists all LiaisonItemUser entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('InfinityGamesInfinityBundle:LiaisonItemUser')->findAll();

        return $this->render('InfinityGamesInfinityBundle:LiaisonItemUser:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a LiaisonItemUser entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:LiaisonItemUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find LiaisonItemUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:LiaisonItemUser:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new LiaisonItemUser entity.
     *
     */
    public function newAction()
    {
        $entity = new LiaisonItemUser();
        $form   = $this->createForm(new LiaisonItemUserType(), $entity);

        return $this->render('InfinityGamesInfinityBundle:LiaisonItemUser:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new LiaisonItemUser entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new LiaisonItemUser();
        $form = $this->createForm(new LiaisonItemUserType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('liaisonitemuser_show', array('id' => $entity->getId())));
        }

        return $this->render('InfinityGamesInfinityBundle:LiaisonItemUser:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing LiaisonItemUser entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:LiaisonItemUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find LiaisonItemUser entity.');
        }

        $editForm = $this->createForm(new LiaisonItemUserType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:LiaisonItemUser:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing LiaisonItemUser entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:LiaisonItemUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find LiaisonItemUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new LiaisonItemUserType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('liaisonitemuser_edit', array('id' => $id)));
        }

        return $this->render('InfinityGamesInfinityBundle:LiaisonItemUser:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a LiaisonItemUser entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('InfinityGamesInfinityBundle:LiaisonItemUser')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find LiaisonItemUser entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('liaisonitemuser'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    
}
