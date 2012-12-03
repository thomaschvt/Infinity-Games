<?php

namespace InfinityGames\InfinityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use InfinityGames\InfinityBundle\Entity\GenreJeu;
use InfinityGames\InfinityBundle\Form\GenreJeuType;

/**
 * GenreJeu controller.
 *
 */
class GenreJeuController extends Controller
{
    /**
     * Lists all GenreJeu entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('InfinityGamesInfinityBundle:GenreJeu')->findAll();

        return $this->render('InfinityGamesInfinityBundle:GenreJeu:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a GenreJeu entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:GenreJeu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GenreJeu entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:GenreJeu:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new GenreJeu entity.
     *
     */
    public function newAction()
    {
        $entity = new GenreJeu();
        $form   = $this->createForm(new GenreJeuType(), $entity);

        return $this->render('InfinityGamesInfinityBundle:GenreJeu:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new GenreJeu entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new GenreJeu();
        $form = $this->createForm(new GenreJeuType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('genrejeu_show', array('id' => $entity->getId())));
        }

        return $this->render('InfinityGamesInfinityBundle:GenreJeu:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing GenreJeu entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:GenreJeu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GenreJeu entity.');
        }

        $editForm = $this->createForm(new GenreJeuType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:GenreJeu:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing GenreJeu entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:GenreJeu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GenreJeu entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new GenreJeuType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('genrejeu_edit', array('id' => $id)));
        }

        return $this->render('InfinityGamesInfinityBundle:GenreJeu:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a GenreJeu entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('InfinityGamesInfinityBundle:GenreJeu')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find GenreJeu entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('genrejeu'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
