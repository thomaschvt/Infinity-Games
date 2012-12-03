<?php

namespace InfinityGames\InfinityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GenreJeu
 *
 * @ORM\Table(name="genre_jeu")
 * @ORM\Entity
 */
class GenreJeu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_genre_jeu", type="integer", nullable=false)
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
     * @ORM\Column(name="descriptif", type="string", length=45, nullable=true)
     */
    private $descriptif;

    /**
     * @var string
     *
     * @ORM\Column(name="visu_picto", type="string", length=100, nullable=true)
     */
    private $visuPicto;



    /**
     * Get idGenreJeu
     *
     * @return integer 
     */
    public function getIdGenreJeu()
    {
        return $this->idGenreJeu;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     * @return GenreJeu
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
     * @return GenreJeu
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
     * Set visuPicto
     *
     * @param string $visuPicto
     * @return GenreJeu
     */
    public function setVisuPicto($visuPicto)
    {
        $this->visuPicto = $visuPicto;
    
        return $this;
    }

    /**
     * Get visuPicto
     *
     * @return string 
     */
    public function getVisuPicto()
    {
        return $this->visuPicto;
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
    public function __toString() {
    	return $this->intitule;
    }
}