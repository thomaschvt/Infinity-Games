<?php

namespace InfinityGames\InfinityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MessageForum
 *
 * @ORM\Table(name="message_forum")
 * @ORM\Entity
 */
class MessageForum
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_topic_forum", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=45, nullable=true)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text", nullable=true)
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=45, nullable=true)
     */
    private $statut;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id_utilisateur")
     * })
     */
    private $utilisateur;

    /**
     * @var \ForumCategorie
     *
     * @ORM\ManyToOne(targetEntity="ForumCategorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="forum_id", referencedColumnName="id")
     * })
     */
    private $forum;

    /**
     * @var \MessageForum
     *
     * @ORM\ManyToOne(targetEntity="MessageForum")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parent", referencedColumnName="id_topic_forum")
     * })
     */
    private $idParent;



    /**
     * Get idTopicForum
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
     * @return MessageForum
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
     * @return MessageForum
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
     * Set date
     *
     * @param \DateTime $date
     * @return MessageForum
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set statut
     *
     * @param string $statut
     * @return MessageForum
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
     * Set utilisateur
     *
     * @param \InfinityGames\InfinityBundle\Entity\Utilisateur $utilisateur
     * @return MessageForum
     */
    public function setUtilisateur(\InfinityGames\InfinityBundle\Entity\Utilisateur $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;
    
        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \InfinityGames\InfinityBundle\Entity\Utilisateur 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set forum
     *
     * @param \InfinityGames\InfinityBundle\Entity\ForumCategorie $forum
     * @return MessageForum
     */
    public function setForum(\InfinityGames\InfinityBundle\Entity\ForumCategorie $forum = null)
    {
        $this->forum = $forum;
    
        return $this;
    }

    /**
     * Get forum
     *
     * @return \InfinityGames\InfinityBundle\Entity\ForumCategorie 
     */
    public function getForum()
    {
        return $this->forum;
    }

    /**
     * Set idParent
     *
     * @param \InfinityGames\InfinityBundle\Entity\MessageForum $idParent
     * @return MessageForum
     */
    public function setIdParent(\InfinityGames\InfinityBundle\Entity\MessageForum $idParent = null)
    {
        $this->idParent = $idParent;
    
        return $this;
    }
	
    /**
     * Get idParent
     *
     * @return \InfinityGames\InfinityBundle\Entity\MessageForum 
     */
    public function getIdParent()
    {
        return $this->idParent;
    }
}