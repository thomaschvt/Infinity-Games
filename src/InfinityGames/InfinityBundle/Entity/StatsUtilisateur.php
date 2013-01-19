<?php

namespace InfinityGames\InfinityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatsUtilisateur
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class StatsUtilisateur
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbr_utilisateurs", type="integer")
     */
    private $nbr_utilisateurs;


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
     * Set date
     *
     * @param \DateTime $date
     * @return StatsUtilisateur
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
     * Set nbr_utilisateurs
     *
     * @param integer $nbrUtilisateurs
     * @return StatsUtilisateur
     */
    public function setNbrUtilisateurs($nbrUtilisateurs)
    {
        $this->nbr_utilisateurs = $nbrUtilisateurs;
    
        return $this;
    }

    /**
     * Get nbr_utilisateurs
     *
     * @return integer 
     */
    public function getNbrUtilisateurs()
    {
        return $this->nbr_utilisateurs;
    }
}
