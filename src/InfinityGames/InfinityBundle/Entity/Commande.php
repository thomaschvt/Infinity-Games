<?php

namespace InfinityGames\InfinityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="Commande")
 * @ORM\Entity
 */
class Commande
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ref_commande", type="string", length=15, nullable=false)
     */
    private $refCommande;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_commande", type="datetime", nullable=false)
     */
    private $dateCommande;

    /**
     * @var integer
     *
     * @ORM\Column(name="px_total", type="integer", nullable=false)
     */
    private $pxTotal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_transaction", type="datetime", nullable=false)
     */
    private $dateTransaction;

    /**
     * @var string
     *
     * @ORM\Column(name="retour_paypal", type="string", length=10, nullable=true)
     */
    private $retourPaypal;
	
    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=11, nullable=true)
     */
    private $statut;
    
    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id_utilisateur")
     * })
     */
    private $utilisateur;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set refCommande
     *
     * @param string $refCommande
     * @return Commande
     */
    public function setRefCommande($refCommande)
    {
        $this->refCommande = $refCommande;
    
        return $this;
    }

    /**
     * Get refCommande
     *
     * @return string 
     */
    public function getRefCommande()
    {
        return $this->refCommande;
    }

    /**
     * Set dateCommande
     *
     * @param \DateTime $dateCommande
     * @return Commande
     */
    public function setDateCommande($dateCommande)
    {
        $this->dateCommande = $dateCommande;
    
        return $this;
    }

    /**
     * Get dateCommande
     *
     * @return \DateTime 
     */
    public function getDateCommande()
    {
        return $this->dateCommande;
    }

    /**
     * Set pxTotal
     *
     * @param integer $pxTotal
     * @return Commande
     */
    public function setPxTotal($pxTotal)
    {
        $this->pxTotal = $pxTotal;
    
        return $this;
    }

    /**
     * Get pxTotal
     *
     * @return integer 
     */
    public function getPxTotal()
    {
        return $this->pxTotal;
    }
    
    /**
     * Set statut
     *
     * @param string $statut
     * @return Commande
     */
    public function setStatut($statut)
    {
    	$this->statut = $statut;
    
    	return $this;
    }
    
    /**
     * Get pxTotal
     *
     * @return integer
     */
    public function getStatut()
    {
    	return $this->statut;
    }

    /**
     * Set dateTransaction
     *
     * @param \DateTime $dateTransaction
     * @return Commande
     */
    public function setDateTransaction($dateTransaction)
    {
        $this->dateTransaction = $dateTransaction;
    
        return $this;
    }

    /**
     * Get dateTransaction
     *
     * @return \DateTime 
     */
    public function getDateTransaction()
    {
        return $this->dateTransaction;
    }

    /**
     * Set retourPaypal
     *
     * @param string $retourPaypal
     * @return Commande
     */
    public function setRetourPaypal($retourPaypal)
    {
        $this->retourPaypal = $retourPaypal;
    
        return $this;
    }

    /**
     * Get retourPaypal
     *
     * @return string 
     */
    public function getRetourPaypal()
    {
        return $this->retourPaypal;
    }

    /**
     * Set utilisateur
     *
     * @param \InfinityGames\InfinityBundle\Entity\Utilisateur $utilisateur
     * @return Commande
     */
    public function setUtilisateur(\InfinityGames\InfinityBundle\Entity\Utilisateur $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;
    
        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \InfinityGames\InfinityBundle\Entity\Utilisateur 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }
}