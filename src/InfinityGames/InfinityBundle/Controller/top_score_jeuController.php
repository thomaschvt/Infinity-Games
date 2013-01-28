<?php

namespace InfinityGames\InfinityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use InfinityGames\InfinityBundle\Entity\top_score_jeu;
use InfinityGames\InfinityBundle\Form\top_score_jeuType;

/**
 * top_score_jeu controller.
 *
 */
class top_score_jeuController extends Controller
{
    /**
     * Lists all top_score_jeu entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('InfinityGamesInfinityBundle:top_score_jeu')->findAll();

        return $this->render('InfinityGamesInfinityBundle:top_score_jeu:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a top_score_jeu entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:top_score_jeu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find top_score_jeu entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:top_score_jeu:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new top_score_jeu entity.
     *
     */
    public function newAction()
    {
        $entity = new top_score_jeu();
        $form   = $this->createForm(new top_score_jeuType(), $entity);

        return $this->render('InfinityGamesInfinityBundle:top_score_jeu:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new top_score_jeu entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new top_score_jeu();
        $form = $this->createForm(new top_score_jeuType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('top_score_jeu_show', array('id' => $entity->getId())));
        }

        return $this->render('InfinityGamesInfinityBundle:top_score_jeu:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing top_score_jeu entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:top_score_jeu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find top_score_jeu entity.');
        }

        $editForm = $this->createForm(new top_score_jeuType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:top_score_jeu:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing top_score_jeu entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:top_score_jeu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find top_score_jeu entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new top_score_jeuType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('top_score_jeu_edit', array('id' => $id)));
        }

        return $this->render('InfinityGamesInfinityBundle:top_score_jeu:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a top_score_jeu entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('InfinityGamesInfinityBundle:top_score_jeu')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find top_score_jeu entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('top_score_jeu'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
