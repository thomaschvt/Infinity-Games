<?php

namespace InfinityGames\InfinityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArticlesFactory
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ArticlesFactory
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
     * @ORM\Column(name="titre", type="string", length=50)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
     * @var \CategorieFactory
     *
     * @ORM\ManyToOne(targetEntity="CategorieFactory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_categorie", referencedColumnName="id")
     * })
     */
    private $id_categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=20)
     */
    private $statut;


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
     * Set titre
     *
     * @param string $titre
     * @return ArticlesFactory
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    
        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return ArticlesFactory
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    
        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set id_categorie
     *
     * @param integer $idCategorie
     * @return ArticlesFactory
     */
    public function setIdCategorie($idCategorie)
    {
        $this->id_categorie = $idCategorie;
    
        return $this;
    }

    /**
     * Get id_categorie
     *
     * @return integer 
     */
    public function getIdCategorie()
    {
        return $this->id_categorie;
    }

    /**
     * Set statut
     *
     * @param string $statut
     * @return ArticlesFactory
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
}
