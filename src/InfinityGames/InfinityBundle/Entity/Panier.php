<?php

namespace InfinityGames\InfinityBundle\Entity;

use InfinityGames\InfinityBundle\Entity\DescripifItemStore;


class Panier{
	/*
	 * Attributs de la classe Caddie
	*/
	
	private $produits;
	private $nbProduits;
	private $prixHT;
	private $idClient;
	public static $TVA = 19.6;
	
	/**
	 * Constructeur de la classe Caddie
	 * @param float $tva : par defaut TVA française
	 */
	public function __construct($tva = 19.6) {
		/* FIXME: Il faudrait tester le type et la valeur de $tva */
		$this->produits = array();
		$this->nbProduits = 0;
		$this->prixHT = 0;
		$this->ipClient = $this->getIpAction();
		self::$TVA = $tva;
	}
	
	/*
	 * Accesseurs et modifieurs
	*/
	
	/**
	 * recupère les produits ...
	 */
	public function getProduits() {
		return $this->produits;
	}
	
	/**
	 * Retourne le prix global hors-taxe du caddie
	 */
	public function getPrixHT() {
		return $this->prixHT;
	}
	
	/**
	 * 
	 * @return unknown
	 */
	public function getPrixTTC() {
		$prixTTC = $this->prixHT * (1 + self::$TVA / 100);
		return $prixTTC;
	}
	
	/**
	 * Retourne la quantité d'un produit du caddie
	 * en fonction de son identifiant
	 * @param integer $id Identifiant produit (base de données)
	 */
	public function getQttUnitProduit($id)
	{
		return $this->produits[$id]['qtt'];
	}
	
	/**
	 * Enter description here ...
	 */
	public function getNbProduits() {
		return $this->nbProduits;
	}
	
	/**
	 * Modification de la TVA
	 * @param float $tva : par défaut tva française(19.6);
	 */
	public function setTva($tva) {
		if (($tva > 0) && is_numeric($tva)) {
			self::$TVA = $tva;
		}
	}
	
	
	/*
	 * Méthodes spécifiques
	*/
	
	/**
	 * Ajouter un produit au caddie
	 * @param int $id
	 * @param string $nom
	 * @param string $designation
	 * @param numeric $prixHT
	 */
	public function ajouter($id, $nom, $designation, $prixHT) {
			
		if (is_numeric($prixHT) && ($prixHT > 0)) {
			if (array_key_exists($id, $this->produits)){
				$this->ajouterQtt($id, $nom, $designation, $prixHT, 1);
			} else {
				$this->produits[$id] = array(
						'id'=>$id,
						'nom' => $nom,
						'designation' => $designation,
						'prixHT' => $prixHT,
						'qtt' => 1
				);
				$this->nbProduits++;
				$this->prixHT += $prixHT;
			}
		}
	}
	
	/**
	 * Ajouter le produit avec une quantite
	 * @param int $id
	 * @param string $nom
	 * @param string $designation
	 * @param numeric $prixHT
	 * @param int $qtt : quantité supp à 0 sinon 1 par defaut
	 */
	public function ajouterQtt($id, $nom, $designation, $prixHT, $qtt=1) {
		if (!(is_numeric($qtt) && $qtt > 0)) {
			$qtt = 1;
		}
	
		if (array_key_exists($id,$this->produits)) {
			$this->produits[$id]['qtt'] += $qtt ;
			$this->prixHT += $prixHT * $qtt;
			$this->nbProduits += $qtt;
		} else {
			// TODO: traitement d'erreur (le produit n'existe pas)
		}
	}
	
	/**
	 * Diminuer la quantite d'un produit
	 * @param int $id
	 * @param string $nom
	 * @param string $designation
	 * @param numeric $prixHT
	 * @param int $qtt : quantité supp à 0 sinon 1 par defaut
	 */
	public function diminuerQtt($id, $nom, $designation, $prixHT, $qtt=1) {
		if (!(is_numeric($qtt) && $qtt > 0)) {
			$qtt = 1;
		}
		if (array_key_exists($id,$this->produits)) {
			if (($this->produits[$id]['qtt'] - $qtt) > 0) {
				$this->produits[$id]['qtt'] -= $qtt ;
				$this->prixHT -= $prixHT * $qtt;
				$this->nbProduits -= $qtt;
			} else {
				$this->supprimer($id);
			}
		} else {
			// TODO: traitement d'erreur (le produit n'existe pas)
		}
	}
	
	
	/**
	 * Suppression d'un produit du caddie
	 * @param int $id
	 */
	public function supprimer($id) {
		if (array_key_exists($id,$this->produits)){
			$prixHT = $this->produits[$id]['prixHT'];
			$qtt = $this->produits[$id]['qtt'];
	
			unset($this->produits[$id]);
	
			$this->nbProduits -= $qtt;
			$this->prixHT -= ($qtt * $prixHT);
		} 
	}
	
	public function vider(){
		
		
	}
	
	/**
	 * Affiche la structure Array contenant les produits (pour le développeur)
	 * @return string
	 */
	public function structureProd() {
		return '<pre>' . print_r($this->produits, true) . '</pre>';
	}
	/**
	 * recupère l'ip de l'utilisateur pour la commande 
	 */
	public function getIpAction(){
		if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}elseif(isset($_SERVER['HTTP_CLIENT_IP'])){
			return $_SERVER['HTTP_CLIENT_IP'];
		}
		else{
			return $_SERVER['REMOTE_ADDR'];
		}
	}
	
	/**
	 * Destructeur de la classe Caddie
	 */
	public function __destruct() {
		// Destruction automatique
	}
}
