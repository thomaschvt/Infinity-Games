<?php

namespace InfinityGames\InfinityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jeu
 *
 * @ORM\Table(name="jeu")
 * @ORM\Entity
 */
class Jeu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_jeu", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=45, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=45, nullable=true)
     */
    private $note;
	
    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=10, nullable=true)
     */
    private $statut;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdat", type="datetime", nullable=true)
     */
    private $createdat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updateda", type="datetime", nullable=true)
     */
    private $updateda;

    /**
     * @var string
     *
     * @ORM\Column(name="visuel_img", type="string", length=150, nullable=true)
     */
    private $visuelImg;

    /**
     * @var string
     *
     * @ORM\Column(name="dest_index", type="string", length=150, nullable=true)
     */
    private $destIndex;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="utilisateur_id_utilisateur", referencedColumnName="id_utilisateur")
     * })
     */
    private $utilisateurUtilisateur;

    /**
     * @var \GenreJeu
     *
     * @ORM\ManyToOne(targetEntity="GenreJeu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="genre_jeu_id_genre_jeu", referencedColumnName="id_genre_jeu")
     * })
     */
    private $genreJeuGenreJeu;



    /**
     * Get idJeu
     *
     * @return integer 
     */
    public function getIdJeu()
    {
        return $this->idJeu;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Jeu
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return Jeu
     */
    public function setNote($note)
    {
        $this->note = $note;
    
        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set createdat
     *
     * @param \DateTime $createdat
     * @return Jeu
     */
    public function setCreatedat($createdat)
    {
        $this->createdat = $createdat;
    
        return $this;
    }

    /**
     * Get createdat
     *
     * @return \DateTime 
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

    /**
     * Set updateda
     *
     * @param \DateTime $updateda
     * @return Jeu
     */
    public function setUpdateda($updateda)
    {
        $this->updateda = $updateda;
    
        return $this;
    }

    /**
     * Get updateda
     *
     * @return \DateTime 
     */
    public function getUpdateda()
    {
        return $this->updateda;
    }

    /**
     * Set visuelImg
     *
     * @param string $visuelImg
     * @return Jeu
     */
    public function setVisuelImg($visuelImg)
    {
        $this->visuelImg = $visuelImg;
    
        return $this;
    }

    /**
     * Get visuelImg
     *
     * @return string 
     */
    public function getVisuelImg()
    {
        return $this->visuelImg;
    }

    /**
     * Set destIndex
     *
     * @param string $destIndex
     * @return Jeu
     */
    public function setDestIndex($destIndex)
    {
        $this->destIndex = $destIndex;
    
        return $this;
    }

    /**
     * Get destIndex
     *
     * @return string 
     */
    public function getDestIndex()
    {
        return $this->destIndex;
    }

    /**
     * Set utilisateurUtilisateur
     *
     * @param \InfinityGames\InfinityBundle\Entity\Utilisateur $utilisateurUtilisateur
     * @return Jeu
     */
    public function setUtilisateurUtilisateur(\InfinityGames\InfinityBundle\Entity\Utilisateur $utilisateurUtilisateur = null)
    {
        $this->utilisateurUtilisateur = $utilisateurUtilisateur;
    
        return $this;
    }

    /**
     * Get utilisateurUtilisateur
     *
     * @return \InfinityGames\InfinityBundle\Entity\Utilisateur 
     */
    public function getUtilisateurUtilisateur()
    {
        return $this->utilisateurUtilisateur;
    }

    /**
     * Set genreJeuGenreJeu
     *
     * @param \InfinityGames\InfinityBundle\Entity\GenreJeu $genreJeuGenreJeu
     * @return Jeu
     */
    public function setGenreJeuGenreJeu(\InfinityGames\InfinityBundle\Entity\GenreJeu $genreJeuGenreJeu = null)
    {
        $this->genreJeuGenreJeu = $genreJeuGenreJeu;
    
        return $this;
    }

    /**
     * Get genreJeuGenreJeu
     *
     * @return \InfinityGames\InfinityBundle\Entity\GenreJeu 
     */
    public function getGenreJeuGenreJeu()
    {
        return $this->genreJeuGenreJeu;
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
    	return $this->nom;
    }

    /**
     * Set statut
     *
     * @param string $statut
     * @return Jeu
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