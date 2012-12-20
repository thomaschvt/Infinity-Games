<?php

namespace InfinityGames\InfinityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContenuCommande
 *
 * @ORM\Table(name="Contenu_commande")
 * @ORM\Entity
 */
class ContenuCommande
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
     * @var integer
     *
     * @ORM\Column(name="qte_item", type="integer", nullable=false)
     */
    private $qteItem;

    /**
     * @var float
     *
     * @ORM\Column(name="px_unitaire", type="float", nullable=false)
     */
    private $pxUnitaire;

    /**
     * @var \Commande
     *
     * @ORM\ManyToOne(targetEntity="Commande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_commande", referencedColumnName="id")
     * })
     */
    private $idCommande;

    /**
     * @var \DescripifItemStore
     *
     * @ORM\ManyToOne(targetEntity="DescripifItemStore")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_item", referencedColumnName="id_item_store")
     * })
     */
    private $idItem;



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
     * Set qteItem
     *
     * @param integer $qteItem
     * @return ContenuCommande
     */
    public function setQteItem($qteItem)
    {
        $this->qteItem = $qteItem;
    
        return $this;
    }

    /**
     * Get qteItem
     *
     * @return integer 
     */
    public function getQteItem()
    {
        return $this->qteItem;
    }

    /**
     * Set pxUnitaire
     *
     * @param float $pxUnitaire
     * @return ContenuCommande
     */
    public function setPxUnitaire($pxUnitaire)
    {
        $this->pxUnitaire = $pxUnitaire;
    
        return $this;
    }

    /**
     * Get pxUnitaire
     *
     * @return float 
     */
    public function getPxUnitaire()
    {
        return $this->pxUnitaire;
    }

    /**
     * Set idCommande
     *
     * @param \InfinityGames\InfinityBundle\Entity\Commande $idCommande
     * @return ContenuCommande
     */
    public function setIdCommande(\InfinityGames\InfinityBundle\Entity\Commande $idCommande = null)
    {
        $this->idCommande = $idCommande;
    
        return $this;
    }

    /**
     * Get idCommande
     *
     * @return \InfinityGames\InfinityBundle\Entity\Commande 
     */
    public function getIdCommande()
    {
        return $this->idCommande;
    }

    /**
     * Set idItem
     *
     * @param \InfinityGames\InfinityBundle\Entity\DescripifItemStore $idItem
     * @return ContenuCommande
     */
    public function setIdItem(\InfinityGames\InfinityBundle\Entity\DescripifItemStore $idItem = null)
    {
        $this->idItem = $idItem;
    
        return $this;
    }

    /**
     * Get idItem
     *
     * @return \InfinityGames\InfinityBundle\Entity\DescripifItemStore 
     */
    public function getIdItem()
    {
        return $this->idItem;
    }
}