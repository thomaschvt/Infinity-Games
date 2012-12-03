<?php

namespace InfinityGames\InfinityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NiveauExperience
 *
 * @ORM\Table(name="niveau_experience")
 * @ORM\Entity
 */
class NiveauExperience
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_niveau_experience", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="limite_haute", type="integer", nullable=true)
     */
    private $limiteHaute;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="limite_basse", type="integer", nullable=true)
     */
    private $limiteBasse;

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
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=10, nullable=true)
     */
    private $statut;

    /**
     * Get idNiveauExperience
     *
     * @return integer 
     */
    public function getIdNiveauExperience()
    {
        return $this->idNiveauExperience;
    }

    /**
     * Set limiteHaute
     *
     * @param integer $limiteHaute
     * @return NiveauExperience
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
     * @return NiveauExperience
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
     * @return NiveauExperience
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
     * Set statut
     *
     * @param string $statut
     * @return NiveauExperience
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
     * Set limiteBasse
     *
     * @param integer $limiteBasse
     * @return NiveauExperience
     */
    public function setLimiteBasse($limiteBasse)
    {
        $this->limiteBasse = $limiteBasse;
    
        return $this;
    }

    /**
     * Get limiteBasse
     *
     * @return integer 
     */
    public function getLimiteBasse()
    {
        return $this->limiteBasse;
    }
}