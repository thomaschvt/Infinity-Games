<?php

namespace InfinityGames\ProfilUtilisateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InfinityGames\ProfilUtilisateurBundle\Entity\MessageInterne
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class MessageInterne
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
     * @var integer $expediteur
     *
     * @ORM\Column(name="expediteur", type="integer")
     */
    private $expediteur;

    /**
     * @var string $titre_message
     *
     * @ORM\Column(name="titre_message", type="string", length=50)
     */
    private $titre_message;

    /**
     * @var string $contenu_msg
     *
     * @ORM\Column(name="contenu_msg", type="text")
     */
    private $contenu_msg;

    /**
     * @var \DateTime $created_at
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;
	
    /**
     * @ORM\ManyToOne(targetEntity="InfinityGames\InscriptionBundle\Entity\Utilisateur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $destinataire;

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
     * Set expediteur
     *
     * @param integer $expediteur
     * @return MessageInterne
     */
    public function setExpediteur($expediteur)
    {
        $this->expediteur = $expediteur;
    
        return $this;
    }

    /**
     * Get expediteur
     *
     * @return integer 
     */
    public function getExpediteur()
    {
        return $this->expediteur;
    }

    /**
     * Set titre_message
     *
     * @param string $titreMessage
     * @return MessageInterne
     */
    public function setTitreMessage($titreMessage)
    {
        $this->titre_message = $titreMessage;
    
        return $this;
    }

    /**
     * Get titre_message
     *
     * @return string 
     */
    public function getTitreMessage()
    {
        return $this->titre_message;
    }

    /**
     * Set contenu_msg
     *
     * @param string $contenuMsg
     * @return MessageInterne
     */
    public function setContenuMsg($contenuMsg)
    {
        $this->contenu_msg = $contenuMsg;
    
        return $this;
    }

    /**
     * Get contenu_msg
     *
     * @return string 
     */
    public function getContenuMsg()
    {
        return $this->contenu_msg;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return MessageInterne
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

    /**
     * Set destinataire
     *
     * @param InfinityGames\InscriptionBundle\Entity\Utilisateur $destinataire
     * @return MessageInterne
     */
    public function setDestinataire(\InfinityGames\InscriptionBundle\Entity\Utilisateur $destinataire)
    {
        $this->destinataire = $destinataire;
    
        return $this;
    }

    /**
     * Get destinataire
     *
     * @return InfinityGames\InscriptionBundle\Entity\Utilisateur 
     */
    public function getDestinataire()
    {
        return $this->destinataire;
    }
}