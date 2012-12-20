<?php

namespace InfinityGames\InfinityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity
 */
class Utilisateur extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_utilisateur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
   protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=45, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=45, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar_url", type="string", length=45, nullable=true)
     */
    private $avatarUrl;

    /**
     * @var integer
     *
     * @ORM\Column(name="high_score", type="integer", nullable=true)
     */
    private $highScore;

    /**
     * @var integer
     *
     * @ORM\Column(name="experience", type="integer", nullable=true)
     */
    private $experience;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbr_creation", type="integer", nullable=true)
     */
    private $nbrCreation;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="string", length=45, nullable=true)
     */
    private $mdp;

    /**
     * @var integer
     *
     * @ORM\Column(name="credits", type="integer", nullable=true)
     */
    private $credits;

    /**
     * @var string
     *
     * @ORM\Column(name="statut_developpeur", type="string", length=45, nullable=true)
     */
    private $statutDeveloppeur;

    /**
     * @var string
     *
     * @ORM\Column(name="bonus_blason_id", type="string", length=45, nullable=true)
     */
    private $bonusBlasonId;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="DescripifItemStore", mappedBy="idUtilisateur")
     */
    private $idItemStore;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idItemStore = new \Doctrine\Common\Collections\ArrayCollection();
        parent::__construct();
    }
    

    /**
     * Get idUtilisateur
     *
     * @return integer 
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    
        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Utilisateur
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
     * Set avatarUrl
     *
     * @param string $avatarUrl
     * @return Utilisateur
     */
    public function setAvatarUrl($avatarUrl)
    {
        $this->avatarUrl = $avatarUrl;
    
        return $this;
    }

    /**
     * Get avatarUrl
     *
     * @return string 
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }

    /**
     * Set highScore
     *
     * @param integer $highScore
     * @return Utilisateur
     */
    public function setHighScore($highScore)
    {
        $this->highScore = $highScore;
    
        return $this;
    }

    /**
     * Get highScore
     *
     * @return integer 
     */
    public function getHighScore()
    {
        return $this->highScore;
    }

    /**
     * Set experience
     *
     * @param integer $experience
     * @return Utilisateur
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;
    
        return $this;
    }

    /**
     * Get experience
     *
     * @return integer 
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * Set nbrCreation
     *
     * @param integer $nbrCreation
     * @return Utilisateur
     */
    public function setNbrCreation($nbrCreation)
    {
        $this->nbrCreation = $nbrCreation;
    
        return $this;
    }

    /**
     * Get nbrCreation
     *
     * @return integer 
     */
    public function getNbrCreation()
    {
        return $this->nbrCreation;
    }

    /**
     * Set mdp
     *
     * @param string $mdp
     * @return Utilisateur
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    
        return $this;
    }

    /**
     * Get mdp
     *
     * @return string 
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set credits
     *
     * @param integer $credits
     * @return Utilisateur
     */
    public function setCredits($credits)
    {
        $this->credits = $credits;
    
        return $this;
    }

    /**
     * Get credits
     *
     * @return integer 
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * Set statutDeveloppeur
     *
     * @param string $statutDeveloppeur
     * @return Utilisateur
     */
    public function setStatutDeveloppeur($statutDeveloppeur)
    {
        $this->statutDeveloppeur = $statutDeveloppeur;
    
        return $this;
    }

    /**
     * Get statutDeveloppeur
     *
     * @return string 
     */
    public function getStatutDeveloppeur()
    {
        return $this->statutDeveloppeur;
    }

    /**
     * Set bonusBlasonId
     *
     * @param string $bonusBlasonId
     * @return Utilisateur
     */
    public function setBonusBlasonId($bonusBlasonId)
    {
        $this->bonusBlasonId = $bonusBlasonId;
    
        return $this;
    }

    /**
     * Get bonusBlasonId
     *
     * @return string 
     */
    public function getBonusBlasonId()
    {
        return $this->bonusBlasonId;
    }

    /**
     * Add idItemStore
     *
     * @param \InfinityGames\InfinityBundle\Entity\DescripifItemStore $idItemStore
     * @return Utilisateur
     */
    public function addIdItemStore(\InfinityGames\InfinityBundle\Entity\DescripifItemStore $idItemStore)
    {
        $this->idItemStore[] = $idItemStore;
    
        return $this;
    }

    /**
     * Remove idItemStore
     *
     * @param \InfinityGames\InfinityBundle\Entity\DescripifItemStore $idItemStore
     */
    public function removeIdItemStore(\InfinityGames\InfinityBundle\Entity\DescripifItemStore $idItemStore)
    {
        $this->idItemStore->removeElement($idItemStore);
    }

    /**
     * Get idItemStore
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdItemStore()
    {
        return $this->idItemStore;
    }
    
    /**
     * @return \DateTime
     */
//     public function getExpiresAt()
//     {
//     	return $this->expiresAt;
//     }

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
    	return $this->username;
    }
}