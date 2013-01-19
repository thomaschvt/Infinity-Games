<?php

namespace InfinityGames\InfinityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use InfinityGames\InfinityBundle\Entity\Commande;
use InfinityGames\InfinityBundle\Entity\DescripifItemStore;
use InfinityGames\InfinityBundle\Entity\TypeItemStore;
use InfinityGames\InfinityBundle\Entity\Utilisateur;
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
        $entitiesCommande = $em->getRepository('InfinityGamesInfinityBundle:Commande')->findAll();
        $entitiesTypeItem = $em->getRepository('InfinityGamesInfinityBundle:TypeItemStore')->findAll();

        return $this->render('InfinityGamesInfinityBundle:DescripifItemStore:index.html.twig', array(
            'entities' => $entities,
        	'commandes' => $entitiesCommande,
        	'typesItem' => $entitiesTypeItem, 
        ));
    }
    
    /**
     * Affichage du catalogue des objets en ventes
     */
	public function catalogueAction(){
		$em = $this->getDoctrine()->getManager();
		
		$entitiesItem = $em->getRepository('InfinityGamesInfinityBundle:DescripifItemStore')->findAll();
		$entitiesType = $this->getTypeAction();
		$entitiesSsType = $this->getSsTypeAction();
		
		return $this->render('InfinityGamesInfinityBundle:Store:store.html.twig', array(
				'listObj' => $entitiesItem,
				'typeItem' => $entitiesType,
				'sousType' => $entitiesSsType,
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
	 * 
	 */
    public function triItemAction($categorie, $type){
    	
    }
    /**
     * function de recupération de toutes les categories "parente". Renvoi un tableau d'objets TypeItemStore
     */
    private function getTypeAction(){
    	
    	//sinon on recupère toutes les categorie définit comme tel sans restriction de parent
    	$repository = $this->getDoctrine()->getRepository('InfinityGamesInfinityBundle:TypeItemStore');
    	$query = $repository->createQueryBuilder('t')
    	->where('t.id_parent IS NULL')
    	->getQuery();
    	$entitiesType = $query->getResult();
    	return $entitiesType;
    }
    /**
	 * function de recupération de toutes les sous-categories. Renvoi un tableau d'objets TypeItemStore
	 */
    private function getSsTypeAction(){
    	   	
    	//on recupère toutes les categorie définit comme tel sans restriction de parent
    	$repository = $this->getDoctrine()->getRepository('InfinityGamesInfinityBundle:TypeItemStore');
    	$query = $repository->createQueryBuilder('t')
    	->where('t.id_parent IS NOT NULL')
    	->getQuery();
    	$ssType = $query->getResult();
    	return $ssType;
    }
    
    /**
     * Creates a new DescripifItemStore entity.
     *
     */
    public function createAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
        $entity  = new DescripifItemStore();
        $form = $this->createForm(new DescripifItemStoreType(), $entity);
        $form->bind($request);
		
        //on recupère l'entity InfinityAdmin pour définir le user
        $entityUser = $em->getRepository('InfinityGamesInfinityBundle:Utilisateur')->findOneByUsername('InfinityAdmin');
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->addIdUtilisateur($entityUser);
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
	/**
	 * 
	 * @param integer $id, integer $statut
	 */
    public function changeStatutAction($id, $statut){
    	//on crée une entité vide et on récupere l'objet ciblé
    	$entity  = new DescripifItemStore();
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('InfinityGamesInfinityBundle:DescripifItemStore')->find($id);
    	
    	//on déifini le nouveau statut a appliquer
    	if($statut ==1){
    		$newStatut = "actif";
    	}elseif($statut == 2){
    		$newStatut = "inactif";
    	}
    	
    	//on met a jour le statut et repercute en bdd
    	$entity->setStatut($newStatut);
    	$em->remove($entity);
    	$em->flush();
    }
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
