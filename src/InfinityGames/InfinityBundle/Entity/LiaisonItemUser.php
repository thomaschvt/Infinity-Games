<?php

namespace InfinityGames\InfinityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LiaisonItemUser
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="InfinityGames\InfinityBundle\Repository\LiaisonItemUserRepository")
 */
class LiaisonItemUser
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
     * @var \GenreJeu
     *
     * @ORM\ManyToOne(targetEntity="DescripifItemStore")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="item", referencedColumnName="id_item_store")
     * })
     */
    private $item;

    /**
     * @var \GenreJeu
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="utilisateur", referencedColumnName="id_utilisateur")
     * })
     */
    private $utilisateur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_achat", type="date")
     */
    private $date_achat;


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
     * Set item
     *
     * @param integer $item
     * @return LiaisonItemUser
     */
    public function setItem($item)
    {
        $this->item = $item;
    
        return $this;
    }

    /**
     * Get item
     *
     * @return integer 
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set utilisateur
     *
     * @param integer $utilisateur
     * @return LiaisonItemUser
     */
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;
    
        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return integer 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set date_achat
     *
     * @param \DateTime $dateAchat
     * @return LiaisonItemUser
     */
    public function setDateAchat($dateAchat)
    {
        $this->date_achat = $dateAchat;
    
        return $this;
    }

    /**
     * Get date_achat
     *
     * @return \DateTime 
     */
    public function getDateAchat()
    {
        return $this->date_achat;
    }
}
