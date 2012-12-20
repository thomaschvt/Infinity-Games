<?php

namespace InfinityGames\InfinityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NiveauCreation
 *
 * @ORM\Table(name="niveau_creation")
 * @ORM\Entity
 */
class NiveauCreation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_niveau_creation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNiveauCreation;

    /**
     * @var integer
     *
     * @ORM\Column(name="limite_haute", type="integer", nullable=true)
     */
    private $limiteHaute;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=45, nullable=true)
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(name="visu_niveau", type="string", length=45, nullable=true)
     */
    private $visuNiveau;



    /**
     * Get idNiveauCreation
     *
     * @return integer 
     */
    public function getIdNiveauCreation()
    {
        return $this->idNiveauCreation;
    }

    /**
     * Set limiteHaute
     *
     * @param integer $limiteHaute
     * @return NiveauCreation
     */
    public function setLimiteHaute($limiteHaute)
    {
        $this->limiteHaute = $limiteHaute;
    
        return $this;
    }

    /**
     * Get limiteHaute
     *
     * @return integer 
     */
    public function getLimiteHaute()
    {
        return $this->limiteHaute;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     * @return NiveauCreation
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
     * Set visuNiveau
     *
     * @param string $visuNiveau
     * @return NiveauCreation
     */
    public function setVisuNiveau($visuNiveau)
    {
        $this->visuNiveau = $visuNiveau;
    
        return $this;
    }

    /**
     * Get visuNiveau
     *
     * @return string 
     */
    public function getVisuNiveau()
    {
        return $this->visuNiveau;
    }
}