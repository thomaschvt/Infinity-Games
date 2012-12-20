<?php

namespace InfinityGames\InfinityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use InfinityGames\InfinityBundle\Entity\DescripifItemStore;
use InfinityGames\InfinityBundle\Form\DescripifItemStoreType;

/**
 * DescripifItemStore controller.
 *
 */
class DescripifItemStoreController extends Controller
{
    /**
     * Lists all DescripifItemStore entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('InfinityGamesInfinityBundle:DescripifItemStore')->findAll();

        return $this->render('InfinityGamesInfinityBundle:DescripifItemStore:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    /**
     * Affichage du catalogue des objets en ventes
     */
	public function catalogueAction(){
		$em = $this->getDoctrine()->getManager();
		
		$entities = $em->getRepository('InfinityGamesInfinityBundle:DescripifItemStore')->findAll();
		
		return $this->render('InfinityGamesInfinityBundle:Store:store.html.twig', array(
				'listObj' => $entities,
		));
	}
    /**
     * Finds and displays a DescripifItemStore entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:DescripifItemStore')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DescripifItemStore entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:DescripifItemStore:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new DescripifItemStore entity.
     *
     */
    public function newAction()
    {
        $entity = new DescripifItemStore();
        $form   = $this->createForm(new DescripifItemStoreType(), $entity);

        return $this->render('InfinityGamesInfinityBundle:DescripifItemStore:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new DescripifItemStore entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new DescripifItemStore();
        $form = $this->createForm(new DescripifItemStoreType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('descripifitemstore_show', array('id' => $entity->getId())));
        }

        return $this->render('InfinityGamesInfinityBundle:DescripifItemStore:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing DescripifItemStore entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:DescripifItemStore')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DescripifItemStore entity.');
        }

        $editForm = $this->createForm(new DescripifItemStoreType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:DescripifItemStore:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing DescripifItemStore entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:DescripifItemStore')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DescripifItemStore entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new DescripifItemStoreType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('descripifitemstore_edit', array('id' => $id)));
        }

        return $this->render('InfinityGamesInfinityBundle:DescripifItemStore:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a DescripifItemStore entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('InfinityGamesInfinityBundle:DescripifItemStore')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find DescripifItemStore entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('descripifitemstore'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
