<?php

namespace InfinityGames\InfinityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MessageInterne
 *
 * @ORM\Table(name="message_interne")
 * @ORM\Entity(repositoryClass="InfinityGames\InfinityBundle\Repository\MessageInterneRepository")
 */
class MessageInterne
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_message", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_message", type="string", length=45, nullable=true)
     */
    private $titreMessage;
    
    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=45, nullable=true)
     */
    private $statut;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu_message", type="text", nullable=true)
     */
    private $contenuMessage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure", type="datetime", nullable=true)
     */
    private $heure;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="destinataire_id", referencedColumnName="id_utilisateur")
     * })
     */
    private $destinataire;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="expediteur_id", referencedColumnName="id_utilisateur")
     * })
     */
    private $expediteur;



    /**
     * Get idMessage
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titreMessage
     *
     * @param string $titreMessage
     * @return MessageInterne
     */
    public function setTitreMessage($titreMessage)
    {
        $this->titreMessage = $titreMessage;
    
        return $this;
    }

    /**
     * Get titreMessage
     *
     * @return string 
     */
    public function getTitreMessage()
    {
        return $this->titreMessage;
    }
    
	/**
     * Set statut
     *
     * @param string $statut
     * @return $statut
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
     * Set contenuMessage
     *
     * @param string $contenuMessage
     * @return MessageInterne
     */
    public function setContenuMessage($contenuMessage)
    {
        $this->contenuMessage = $contenuMessage;
    
        return $this;
    }

    /**
     * Get contenuMessage
     *
     * @return string 
     */
    public function getContenuMessage()
    {
        return $this->contenuMessage;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return MessageInterne
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
     * Set heure
     *
     * @param \DateTime $heure
     * @return MessageInterne
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;
    
        return $this;
    }

    /**
     * Get heure
     *
     * @return \DateTime 
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * Set destinataire
     *
     * @param \InfinityGames\InfinityBundle\Entity\Utilisateur $destinataire
     * @return MessageInterne
     */
    public function setDestinataire(\InfinityGames\InfinityBundle\Entity\Utilisateur $destinataire = null)
    {
        $this->destinataire = $destinataire;
    
        return $this;
    }

    /**
     * Get destinataire
     *
     * @return \InfinityGames\InfinityBundle\Entity\Utilisateur 
     */
    public function getDestinataire()
    {
        return $this->destinataire;
    }

    /**
     * Set expediteur
     *
     * @param \InfinityGames\InfinityBundle\Entity\Utilisateur $expediteur
     * @return MessageInterne
     */
    public function setExpediteur(\InfinityGames\InfinityBundle\Entity\Utilisateur $expediteur = null)
    {
        $this->expediteur = $expediteur;
    
        return $this;
    }

    /**
     * Get expediteur
     *
     * @return \InfinityGames\InfinityBundle\Entity\Utilisateur 
     */
    public function getExpediteur()
    {
        return $this->expediteur;
    }
}