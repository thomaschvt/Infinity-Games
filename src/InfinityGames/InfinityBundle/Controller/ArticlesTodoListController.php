<?php

namespace InfinityGames\InfinityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use InfinityGames\InfinityBundle\Entity\ArticlesTodoList;
use InfinityGames\InfinityBundle\Form\ArticlesTodoListType;

/**
 * ArticlesTodoList controller.
 *
 */
class ArticlesTodoListController extends Controller
{
    /**
     * Lists all ArticlesTodoList entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('InfinityGamesInfinityBundle:ArticlesTodoList')->findAll();

        return $this->render('InfinityGamesInfinityBundle:ArticlesTodoList:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a ArticlesTodoList entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:ArticlesTodoList')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ArticlesTodoList entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:ArticlesTodoList:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new ArticlesTodoList entity.
     *
     */
    public function newAction()
    {
        $entity = new ArticlesTodoList();
        $form   = $this->createForm(new ArticlesTodoListType(), $entity);

        return $this->render('InfinityGamesInfinityBundle:ArticlesTodoList:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new ArticlesTodoList entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new ArticlesTodoList();
        $form = $this->createForm(new ArticlesTodoListType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
  			$assign = $form->get('utilisateur');
  			
           if($assign == null){
           		
           		$entity->setStatut('Non-assigné');
           		
           }
           $entity->setStatut('Assigné');
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('articlestodolist_show', array('id' => $entity->getId())));
        }

        return $this->render('InfinityGamesInfinityBundle:ArticlesTodoList:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ArticlesTodoList entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:ArticlesTodoList')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ArticlesTodoList entity.');
        }

        $editForm = $this->createForm(new ArticlesTodoListType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:ArticlesTodoList:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing ArticlesTodoList entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:ArticlesTodoList')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ArticlesTodoList entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ArticlesTodoListType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('articlestodolist_edit', array('id' => $id)));
        }

        return $this->render('InfinityGamesInfinityBundle:ArticlesTodoList:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ArticlesTodoList entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('InfinityGamesInfinityBundle:ArticlesTodoList')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ArticlesTodoList entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('articlestodolist'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
