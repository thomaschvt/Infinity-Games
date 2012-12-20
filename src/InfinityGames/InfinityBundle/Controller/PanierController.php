<?php

namespace InfinityGames\InfinityBundle\Controller;

use Symfony\Component\Validator\Constraints\Length;

use Symfony\Component\Validator\Constraints\DateTime;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use InfinityGames\InfinityBundle\Entity\Panier;
use InfinityGames\InfinityBundle\Entity\DescripifItemStore;
use InfinityGames\InfinityBundle\Entity\Commande;
use InfinityGames\InfinityBundle\Entity\ContenuCommande;

class PanierController extends Controller
{
	

    public function indexAction()
    {
    	//recupère le panier
    	$session = $this->getRequest()->getSession();
    	$panierCourant = $session->get('panier');
    	
    	//recupération des infos d'affichage du panier
    	$listProduit = $panierCourant->getProduits();
    	$totalHT = $panierCourant->getPrixHT();
    	$totalTTC = $panierCourant->getPrixTTC();
    	
    	//envoi des infos d'affichage du panier
    	return $this->render('InfinityGamesInfinityBundle:Panier:panier.html.twig', array(
    			'panier'=>$listProduit,
    			'totalHT'=>$totalHT,
    			'totalTTC'=>$totalTTC,
    	));
    	
    }
    /**
	/**
	 * @param id du produit à ajouter au tableau
	 */
	public function addProduitAction($id){	
    	$session = $this->getRequest()->getSession();	
    	//creation de l'objet panier
    	if(!$session->has('panier')){
    		$entitiPanier = new Panier();
    		$session->set('panier', $entitiPanier);
    	}
    	//on recupère l'objet a ajouter
    	$em = $this->getDoctrine()->getManager();
    	$produitaAjouter = $em->getRepository('InfinityGamesInfinityBundle:DescripifItemStore')->find($id);
    	  	
    	$panierCourant = $session->get('panier');
	
 		//maj du panier avec l'objet ajouté
    	$panierRefresh = $panierCourant->ajouter($produitaAjouter->getId(),$produitaAjouter->getIntitule(),$produitaAjouter->getDescriptif(), $produitaAjouter->getPrix());
    	return $this->redirect($this->generateUrl('infinity_games_infinity_panier_affichage'));
    }
    
	/**
	/**
	 * @param id du produt à supprimer du tableau
	 */
    public function supprProduitAction($id){
    	//recupération du panier
    	$session = $this->getRequest()->getSession();
    	$panierCourant = $session->get('panier');
    	//supprime un produit
    	$panierRefresh = $panierCourant->supprimer($id);
    	//renvoi vers l'affichage panier
    	return $this->redirect($this->generateUrl('infinity_games_infinity_panier_affichage'));
    	
    	 
    }
    
    /**
	/**
	 * 
	 */
    public function incrementQttAction($id){
    	//récuperation du panier
    	$session = $this->getRequest()->getSession();
    	$panierCourant = $session->get('panier');
    	//récuperation de l'objet a modifier
    	$em = $this->getDoctrine()->getManager();
    	$produitaModifier = $em->getRepository('InfinityGamesInfinityBundle:DescripifItemStore')->find($id);
    	//action
    	$panierCourant->ajouterQtt($produitaModifier->getId(), $produitaModifier->getIntitule(), $produitaModifier->getDescriptif(), $produitaModifier->getPrix());
    	return $this->redirect($this->generateUrl('infinity_games_infinity_panier_affichage')); 	 	
    }
	public function createForm($type, $data = null, array $options = array()) {
		// TODO: Auto-generated method stub

	}

    
    /**
     *
     *supprimer le panier
     *
     */
    public function viderPanierAction(){
    	
    }
    
    /**
     * valide le panier et passe à l'étape suivante de la commande
     */
    
    public function validationPanierAction(){
    	$session = $this->getRequest()->getSession();
    	$panierCourant = $session->get('panier');
    	
    	$listProduit = $panierCourant->getProduits();
    	$totalHT = $panierCourant->getPrixHT();
    	$totalTTC = $panierCourant->getPrixTTC();
    	
    	//creation du form paypal
    	
    	return $this->render('InfinityGamesInfinityBundle:Panier:validatePanier.html.twig', array(
    			'panier'=>$listProduit,
    			'totalHT'=>$totalHT,
    			'totalTTC'=>$totalTTC,
    	));
    }
    
    public function creationCommandeAction(){
    	//on recupère l'objet panier courant
    	$session = $this->getRequest()->getSession();
    	$panierCourant = $session->get('panier');
    	
		//création de l'objet commande
    	$commande = new Commande();
    	
    	//on défini ses variables avec l'objet panier
    	$utilisateurCourant = $this->get('security.context')->getToken()->getUser();
    	
    	$refCommande = rand(0,999999);
    	$commande->setUtilisateur($utilisateurCourant);
    	$commande->setRefCommande($refCommande);
    	$commande->setDateTransaction(new \DateTime());
    	$commande->setPxTotal($panierCourant->getPrixTTC());
    	$commande->setDateCommande(new \DateTime());
    	
    	
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($commande);
    	$em->flush();
    	
    	//on recupère le nombre de produits dans le panier
    	//$nbrItem = $panierCourant->getProduits().Length;
    	    	
    	foreach ($panierCourant->getProduits() as $item){
			
    		$em = $this->getDoctrine()->getManager();
    		$produit = $em->getRepository('InfinityGamesInfinityBundle:DescripifItemStore')->find($item['id']);
    		var_dump($produit->getId());
    		
    		$obj = new ContenuCommande();
    		$obj->setIdCommande($commande);
    		$obj->setIdItem($produit);
    		$obj->setPxUnitaire($item['prixHT']);
    		$obj->setQteItem($item['qtt']);
    		$em = $this->getDoctrine()->getManager();
	    	$em->persist($obj);
	    	$em->flush();
    	}
    	
    	return $this->redirect($this->generateUrl('infinity_games_infinity_panier_affichage'));
	}
    
    	
}

