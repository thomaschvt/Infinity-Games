<?php

namespace InfinityGames\InscriptionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InfinityGames\InscriptionBundle\Entity\Utilisateur
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Utilisateur
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $nom
     *
     * @ORM\Column(name="nom", type="string", length=50)
     */
    private $nom;
	
    /**
     * @var string $pseudo
     *
     * @ORM\Column(name="pseudo", type="string", length=50)
     */
    private $pseudo;
    
    /**
     * @var string $prenom
     *
     * @ORM\Column(name="prenom", type="string", length=50)
     */
    private $prenom;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;
	
    /**
     * @var string $site
     *
     * @ORM\Column(name="site", type="string", length=255)
     */
    private $site;
    
    /**
     * @var string $avatar
     *
     * @ORM\Column(name="avatar", type="string", length=255)
     */
    private $avatar;

    /**
     * @var integer $high_score
     *
     * @ORM\Column(name="high_score", type="integer")
     */
    private $high_score;

    /**
     * @var integer $nbr_creation
     *
     * @ORM\Column(name="nbr_creation", type="integer")
     */
    private $nbr_creation;

    /**
     * @var string $mdp
     *
     * @ORM\Column(name="mdp", type="string", length=50)
     */
    private $mdp;

    /**
     * @var integer $credits
     *
     * @ORM\Column(name="credits", type="integer")
     */
    private $credits;

    /**
     * @var integer $statut_developper
     *
     * @ORM\Column(name="statut_developper", type="integer")
     */
    private $statut_developper;
    
    /**
     * @var integer $statut
     *
     * @ORM\Column(name="statut", type="integer")
     */
    private $statut;
	
    /**
     * @ORM\Column(type="datetime")
     */
    protected $created_at;
    
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
     * Set email
     *
     * @param string $email
     * @return Utilisateur
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return Utilisateur
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    
        return $this;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set high_score
     *
     * @param integer $highScore
     * @return Utilisateur
     */
    public function setHighScore($highScore)
    {
        $this->high_score = $highScore;
    
        return $this;
    }

    /**
     * Get high_score
     *
     * @return integer 
     */
    public function getHighScore()
    {
        return $this->high_score;
    }

    /**
     * Set nbr_creation
     *
     * @param integer $nbrCreation
     * @return Utilisateur
     */
    public function setNbrCreation($nbrCreation)
    {
        $this->nbr_creation = $nbrCreation;
    
        return $this;
    }

    /**
     * Get nbr_creation
     *
     * @return integer 
     */
    public function getNbrCreation()
    {
        return $this->nbr_creation;
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
     * Set statut_developper
     *
     * @param integer $statutDevelopper
     * @return Utilisateur
     */
    public function setStatutDevelopper($statutDevelopper)
    {
        $this->statut_developper = $statutDevelopper;
    
        return $this;
    }

    /**
     * Get statut_developper
     *
     * @return integer 
     */
    public function getStatutDevelopper()
    {
        return $this->statut_developper;
    }

    /**
     * Set pseudo
     *
     * @param string $pseudo
     * @return Utilisateur
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    
        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string 
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set site
     *
     * @param string $site
     * @return Utilisateur
     */
    public function setSite($site)
    {
        $this->site = $site;
    
        return $this;
    }

    /**
     * Get site
     *
     * @return string 
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set statut
     *
     * @param integer $statut
     * @return Utilisateur
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    
        return $this;
    }

    /**
     * Get statut
     *
     * @return integer 
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Utilisateur
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }
}