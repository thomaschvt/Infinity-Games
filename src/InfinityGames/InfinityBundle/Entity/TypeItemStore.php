<?php

namespace InfinityGames\InfinityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeItemStore
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="InfinityGames\InfinityBundle\Repository\TypeItemStoreRepository")
 */
class TypeItemStore
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=50)
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptif", type="text")
     */
    private $descriptif;

    /**
     * @var \TypeItemStore
     *
     * @ORM\ManyToOne(targetEntity="TypeItemStore")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parent", referencedColumnName="id")
     * })
     */
    private $id_parent;


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
     * Set intitule
     *
     * @param string $intitule
     * @return TypeItemStore
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
     * Set descriptif
     *
     * @param string $descriptif
     * @return TypeItemStore
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
     * Set id_parent
     *
     * @param integer $idParent
     * @return TypeItemStore
     */
    public function setIdParent($idParent)
    {
        $this->id_parent = $idParent;
        return $this;
    }

    /**
     * Get id_parent
     *
     * @return integer 
     */
    public function getIdParent()
    {
        return $this->id_parent;
    }
    
    public function __toString() {
    	return $this->intitule;
    }
}
