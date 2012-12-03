<?php

namespace InfinityGames\InfinityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use InfinityGames\InfinityBundle\Entity\MessageForum;
use InfinityGames\InfinityBundle\Entity\Utilisateur;
use InfinityGames\InfinityBundle\Form\MessageForumType;
use InfinityGames\InfinityBundle\Form\ReponseTopicForumType;

/**
 * MessageForum controller.
 *
 */
class MessageForumController extends Controller
{
    /**
     * Lists all MessageForum entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('InfinityGamesInfinityBundle:MessageForum')->findAll();

        return $this->render('InfinityGamesInfinityBundle:MessageForum:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a MessageForum entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:MessageForum')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MessageForum entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:MessageForum:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new MessageForum entity.
     *
     */
    public function newAction()
    {
        $entity = new MessageForum();
        $form   = $this->createForm(new MessageForumType(), $entity);

        return $this->render('InfinityGamesInfinityBundle:MessageForum:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new MessageForum entity.
     * Attend le formulaire type de creation MessageForumType
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new MessageForum();
        $utilisateurEntity = new Utilisateur();
        $form = $this->createForm(new MessageForumType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setDate(new \DateTime());
            $entity->setStatut("En cours");
            $utilisateurCourant = $this->get('security.context')->getToken()->getUser();
            $utilisateurEntity = $em->getRepository('InfinityGamesInfinityBundle:Utilisateur')->find($utilisateurCourant);
            $entity->setUtilisateur($utilisateurEntity);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('forum_public'));
        }

        return $this->render('InfinityGamesInfinityBundle:MessageForum:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing MessageForum entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:MessageForum')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MessageForum entity.');
        }

        $editForm = $this->createForm(new MessageForumType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfinityGamesInfinityBundle:MessageForum:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing MessageForum entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InfinityGamesInfinityBundle:MessageForum')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MessageForum entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new MessageForumType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('messageforum_edit', array('id' => $id)));
        }

        return $this->render('InfinityGamesInfinityBundle:MessageForum:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a MessageForum entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('InfinityGamesInfinityBundle:MessageForum')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find MessageForum entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('messageforum'));
    }
	
    
    /**
     * Function qui permet de lire un topic - recupère aussi les réponse associés.
     * Créer également le formulaire de réponse au topic.
     * @param id du topic à lire
     */
    public function readTopicAction($id){
    	 
    	$em = $this->getDoctrine()->getManager();
    	$repTopic  = new MessageForum();
    	$form = $this->createForm(new ReponseTopicForumType(), $repTopic);
    	
    	$topicEntity = $em->getRepository('InfinityGamesInfinityBundle:MessageForum')->find($id);
    	$repTopicEntities = $em->getRepository('InfinityGamesInfinityBundle:MessageForum')->findByidParent($id);
    	
    	if (!$topicEntity) {
    		throw $this->createNotFoundException('Ce topic n\'existe pas ou plus.');
    	}
    	$auteurEntity = $topicEntity->getUtilisateur();
    	
    	
    	return $this->render('InfinityGamesInfinityBundle:ForumPublic:topic_public.html.twig', array(
    			'topicEntity' => $topicEntity,
    			'auteurTopic' => $auteurEntity,
    			'formRep' => $form->createView(),
    			'repEntities' => $repTopicEntities,
    			));
    	 
    }
    
    public function repTopicAction(Request $request, $id){
    	
    	$entity  = new MessageForum();
    	$msgParent = new MessageForum();
    	$utilisateurEntity = new Utilisateur();
    	$form = $this->createForm(new ReponseTopicForumType(), $entity);
    	$form->bind($request);
    	
    	if ($form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$entity->setDate(new \DateTime());
    		$entity->setStatut("En cours");
    		$utilisateurCourant = $this->get('security.context')->getToken()->getUser();
    		$utilisateurEntity = $em->getRepository('InfinityGamesInfinityBundle:Utilisateur')->find($utilisateurCourant);
    		//recupérer le msg parent
    		$msgParent = $em->getRepository('InfinityGamesInfinityBundle:MessageForum')->find($id);
    		$entity->setUtilisateur($utilisateurEntity);
    		$entity->setForum($msgParent->getForum());
    		$entity->setUtilisateur($utilisateurEntity);
    		$entity->setIdParent($msgParent);
    		$em->persist($entity);
    		$em->flush();
    	
    		return $this->redirect($this->generateUrl('forum_public'));
    	}
    	
    	return $this->render('InfinityGamesInfinityBundle:MessageForum:new.html.twig', array(
    			'entity' => $entity,
    			'form'   => $form->createView(),
    	));
    	
    }
    
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
