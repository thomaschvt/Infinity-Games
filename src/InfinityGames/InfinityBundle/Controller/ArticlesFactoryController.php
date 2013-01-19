<?php

namespace InfinityGames\InfinityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use InfinityGames\InfinityBundle\Entity\ArticlesFactory;
use InfinityGames\InfinityBundle\Form\ArticlesFactoryType;

/**
 * ArticlesFactory controller.
 *
 */
class ArticlesFactoryController extends Controller
{
    /**
     * Lists all ArticlesFactory entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('InfinityGamesInfinityBundle:ArticlesFactory')->findAll();

        return $this->render('InfinityGamesInfinityBundle:ArticlesFactory:index.html.twig', array(
            'entities' => $entities,
        ));
    }
	
    /**
     * Fonction de changement de statut de l'article. Attend l'id de l' article et le statut à mettre
     * Renvoi sur le listing des articles
     */
    public function changeStatutAction($id, $statut){
    	
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('InfinityGamesInfinityBundle:ArticlesFactory')->findOneById($id);
    	
    	$entity->setStatut($statut);
    	
    	$em->persist($entity);
    	$em->flush();
    	
    	return $this->redirect($this->generateUrl('categoriefactory'));
    }
    
    /**
     * Finds and displays a ArticlesFactory entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:ArticlesFactory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ArticlesFactory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:ArticlesFactory:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new ArticlesFactory entity.
     *
     */
    public function newAction()
    {
        $entity = new ArticlesFactory();
        $form   = $this->createForm(new ArticlesFactoryType(), $entity);

        return $this->render('InfinityGamesInfinityBundle:ArticlesFactory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new ArticlesFactory entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new ArticlesFactory();
        $form = $this->createForm(new ArticlesFactoryType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('articlesfactory_show', array('id' => $entity->getId())));
        }

        return $this->render('InfinityGamesInfinityBundle:ArticlesFactory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ArticlesFactory entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:ArticlesFactory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ArticlesFactory entity.');
        }

        $editForm = $this->createForm(new ArticlesFactoryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:ArticlesFactory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing ArticlesFactory entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:ArticlesFactory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ArticlesFactory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ArticlesFactoryType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('articlesfactory_edit', array('id' => $id)));
        }

        return $this->render('InfinityGamesInfinityBundle:ArticlesFactory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ArticlesFactory entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('InfinityGamesInfinityBundle:ArticlesFactory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ArticlesFactory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('articlesfactory'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
