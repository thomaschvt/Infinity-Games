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
            $entity->setnbrVues(0);
            $entity->setnbrRep(0);
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
    	$this->incremNbrVue($id);
    	
    	
    	
    	if (!$topicEntity) {
    		throw $this->createNotFoundException('Ce topic n\'existe pas ou plus.');
    	}
    	//on recupère l'auteur du message
    	$auteurEntity = $topicEntity->getUtilisateur();
    	//si l'auteur est l'utilisateur qui li le message, le message est considéré comme lu
    	$utilisateurCourant = $this->get('security.context')->getToken()->getUser();
    	if($auteurEntity == $utilisateurCourant){
    		$this->luParAuteur($id,"lu");
    	}
    	
    	
    	
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
    		$this->incremNbrRep($id);
    		$this->luParAuteur($id,"non-lu");
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
     * @param  integer $id, $statut:integer
     * function permettant de changer le statut d'un topic sur le forum en résolu ou clos.
     * Si le topic est clos par un admin, les réponses ne seront plus possibles, voir le topic sera innacessible 
     * 
     */
    
    public function changeStatutAction($id, $statut){
    	$closedTopic  = new MessageForum();
    	$em = $this->getDoctrine()->getManager();
		//défini le nouveau statut du topic
    	if($statut == 1){
    		$newStatut = "En cours";
    	}elseif($statut == 2){
    		$newStatut = "Résolu";
    	}elseif($statut == 3){
    		$newStatut = "Fermé";
    	}
    	
    	//recupère le topic concerné et le modifie
    	$closedTopic = $em->getRepository('InfinityGamesInfinityBundle:MessageForum')->find($id);
    	$closedTopic->setStatut($newStatut);
    	//pousse les maj en bdd
    	$em->persist($closedTopic);
    	$em->flush();
    	//renvoi sur l'index de gestion forum
    	return $this->redirect($this->generateUrl('forumcategorie'));
    }
    
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    private function incremNbrVue($id){
    	//on trouve le message qui est concerné
    	$em = $this->getDoctrine()->getManager();
    	$msg = $em->getRepository('InfinityGamesInfinityBundle:MessageForum')->find($id);
    	
    	//on recupère le nbre de vue du message et on l'incrémente de 1
    	$nbrDeVue = $msg->getnbrVues();
    	$nbrDeVue +=1;
    	
    	//on renvoi en base de données le nouveau nbre de vue
    	$msg->setnbrVues($nbrDeVue);
    	$em->persist($msg);
    	$em->flush();
    }
    
    private function incremNbrRep($id){
    	//on trouve le message qui est concerné
    	$em = $this->getDoctrine()->getManager();
    	$msg = $em->getRepository('InfinityGamesInfinityBundle:MessageForum')->find($id);
    	 
    	//on recupère le nbre de vue du message et on l'incrémente de 1
    	$nbrDeRep = $msg->getnbrRep();
    	$nbrDeRep +=1;
    	 
    	//on renvoi en base de données le nouveau nbre de vue
    	$msg->setnbrRep($nbrDeRep);
    	$em->persist($msg);
    	$em->flush();
    }
    
    private function luParAuteur($id, $lu){
    	$em = $this->getDoctrine()->getManager();
    	$msg = $em->getRepository('InfinityGamesInfinityBundle:MessageForum')->find($id);
    	 	
    	
    	//on renvoi en base de données le nouveau nbre de vue
    	$msg->setLuParAuteur($lu);
    	$em->persist($msg);
    	$em->flush();
    }
}
