<?php

namespace InfinityGames\InfinityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DescripifItemStore
 *
 * @ORM\Table(name="descripif_item_store")
 * @ORM\Entity
 */
class DescripifItemStore
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_item_store", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=45, nullable=true)
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=45, nullable=true)
     */
    private $statut;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptif", type="text", nullable=true)
     */
    private $descriptif;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", nullable=true)
     */
    private $prix;

    /**
     * @var integer
     *
     * @ORM\Column(name="duree_temps", type="integer", nullable=true)
     */
    private $dureeTemps;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Utilisateur", inversedBy="idItemStore")
     * @ORM\JoinTable(name="descripif_item_store_utilisateur",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_item_store", referencedColumnName="id_item_store")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_utilisateur", referencedColumnName="id_utilisateur")
     *   }
     * )
     */
    private $idUtilisateur;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idUtilisateur = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get idItemStore
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     * @return DescripifItemStore
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;
    
        return $this;
    }

    /**
     * Get intitule
     *
     * @return string 
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set statut
     *
     * @param string $statut
     * @return DescripifItemStore
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    
        return $this;
    }

    /**
     * Get statut
     *
     * @return string 
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set descriptif
     *
     * @param string $descriptif
     * @return DescripifItemStore
     */
    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;
    
        return $this;
    }

    /**
     * Get descriptif
     *
     * @return string 
     */
    public function getDescriptif()
    {
        return $this->descriptif;
    }

    /**
     * Set prix
     *
     * @param float $prix
     * @return DescripifItemStore
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    
        return $this;
    }

    /**
     * Get prix
     *
     * @return float 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set dureeTemps
     *
     * @param integer $dureeTemps
     * @return DescripifItemStore
     */
    public function setDureeTemps($dureeTemps)
    {
        $this->dureeTemps = $dureeTemps;
    
        return $this;
    }

    /**
     * Get dureeTemps
     *
     * @return integer 
     */
    public function getDureeTemps()
    {
        return $this->dureeTemps;
    }

    /**
     * Add idUtilisateur
     *
     * @param \InfinityGames\InfinityBundle\Entity\Utilisateur $idUtilisateur
     * @return DescripifItemStore
     */
    public function addIdUtilisateur(\InfinityGames\InfinityBundle\Entity\Utilisateur $idUtilisateur)
    {
        $this->idUtilisateur[] = $idUtilisateur;
    
        return $this;
    }

    /**
     * Remove idUtilisateur
     *
     * @param \InfinityGames\InfinityBundle\Entity\Utilisateur $idUtilisateur
     */
    public function removeIdUtilisateur(\InfinityGames\InfinityBundle\Entity\Utilisateur $idUtilisateur)
    {
        $this->idUtilisateur->removeElement($idUtilisateur);
    }

    /**
     * Get idUtilisateur
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }
}