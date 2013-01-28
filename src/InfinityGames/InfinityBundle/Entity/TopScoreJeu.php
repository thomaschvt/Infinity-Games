<?php

namespace InfinityGames\InfinityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TopScoreJeu
 *
 * @ORM\Table(name="top_score_jeu")
 * @ORM\Entity(repositoryClass="InfinityGames\InfinityBundle\Repository\TopScoreJeuRepository")
 */

class TopScoreJeu
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
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="utilisateur", referencedColumnName="id_utilisateur")
     * })
     */
    private $utilisateur;

    /**
     * @var integer
     *
     * @ORM\Column(name="score", type="integer")
     */
    private $score;
    
    /**
     * @var integer
     *
     * 
     */
    private $position;

    /**
     * @var \Jeu
     *
     * @ORM\ManyToOne(targetEntity="Jeu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="jeu", referencedColumnName="id_jeu")
     * })
     */
    private $jeu_ref;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_at", type="date")
     */
    private $update_at;


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
     * Set utilisateur
     *
     * @param integer $utilisateur
     * @return top_score_jeu
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
     * Set score
     *
     * @param integer $score
     * @return top_score_jeu
     */
    public function setScore($score)
    {
        $this->score = $score;
    
        return $this;
    }

    /**
     * Get score
     *
     * @return integer 
     */
    public function getScore()
    {
        return $this->score;
    }
    
    /**
     * Set position
     *
     * @param integer $position
     * @return top_score_jeu
     */
    public function setPosition($position)
    {
    	$this->position = $position;
    
    	return $this;
    }
    
    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
    	return $this->position;
    }

    /**
     * Set jeu_ref
     *
     * @param integer $jeuRef
     * @return top_score_jeu
     */
    public function setJeuRef($jeuRef)
    {
        $this->jeu_ref = $jeuRef;
    
        return $this;
    }

    /**
     * Get jeu_ref
     *
     * @return integer 
     */
    public function getJeuRef()
    {
        return $this->jeu_ref;
    }

    /**
     * Set update_at
     *
     * @param \DateTime $updateAt
     * @return top_score_jeu
     */
    public function setUpdateAt($updateAt)
    {
        $this->update_at = $updateAt;
    
        return $this;
    }

    /**
     * Get update_at
     *
     * @return \DateTime 
     */
    public function getUpdateAt()
    {
        return $this->update_at;
    }
    
    
}
