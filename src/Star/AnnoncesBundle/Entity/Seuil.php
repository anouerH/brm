<?php

namespace Star\AnnoncesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seuil
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Star\AnnoncesBundle\Entity\SeuilRepository")
 */
class Seuil
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
     * @var integer
     *
     * @ORM\Column(name="nb_points_per_inscription", type="integer")
     */
    private $nbPointsPerInscription;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_points_per_connexion", type="integer")
     */
    private $nbPointsPerConnexion;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_points_per_adds", type="integer")
     */
    private $nbPointsPerAdds;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_points_per_image", type="integer")
     */
    private $nbPointsPerImage;


    /**
     * @var integer
     *
     * @ORM\Column(name="nb_points_per_message", type="integer")
     */
    private $nbPointsPerMessage;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_points_inbox_message", type="integer")
     */
    private $nbPointsInboxMessage;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_points_for_one_star", type="integer")
     */
    private $nbPointsForOneStar;

    /**
     * @var integer
     *
     * @ORM\Column(name="period", type="integer")
     */
    private $period;


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
     * Set nbPointsPerInscription
     *
     * @param integer $nbPointsPerInscription
     * @return Seuil
     */
    public function setNbPointsPerInscription($nbPointsPerInscription)
    {
        $this->nbPointsPerInscription = $nbPointsPerInscription;

        return $this;
    }

    /**
     * Get nbPointsPerInscription
     *
     * @return integer 
     */
    public function getNbPointsPerInscription()
    {
        return $this->nbPointsPerInscription;
    }

    /**
     * Set nbPointsPerConnexion
     *
     * @param integer $nbPointsPerConnexion
     * @return Seuil
     */
    public function setNbPointsPerConnexion($nbPointsPerConnexion)
    {
        $this->nbPointsPerConnexion = $nbPointsPerConnexion;

        return $this;
    }

    /**
     * Get nbPointsPerConnexion
     *
     * @return integer 
     */
    public function getNbPointsPerConnexion()
    {
        return $this->nbPointsPerConnexion;
    }

    /**
     * Set nbPointsPerAdds
     *
     * @param integer $nbPointsPerAdds
     * @return Seuil
     */
    public function setNbPointsPerAdds($nbPointsPerAdds)
    {
        $this->nbPointsPerAdds = $nbPointsPerAdds;

        return $this;
    }

    /**
     * Get nbPointsPerAdds
     *
     * @return integer 
     */
    public function getNbPointsPerAdds()
    {
        return $this->nbPointsPerAdds;
    }

    /**
     * Set nbPointsPerMessage
     *
     * @param integer $nbPointsPerMessage
     * @return Seuil
     */
    public function setNbPointsPerMessage($nbPointsPerMessage)
    {
        $this->nbPointsPerMessage = $nbPointsPerMessage;

        return $this;
    }

    /**
     * Get nbPointsPerMessage
     *
     * @return integer 
     */
    public function getNbPointsPerMessage()
    {
        return $this->nbPointsPerMessage;
    }

    /**
     * Set nbPointsInboxMessage
     *
     * @param integer $nbPointsInboxMessage
     * @return Seuil
     */
    public function setNbPointsInboxMessage($nbPointsInboxMessage)
    {
        $this->nbPointsInboxMessage = $nbPointsInboxMessage;

        return $this;
    }

    /**
     * Get nbPointsInboxMessage
     *
     * @return integer 
     */
    public function getNbPointsInboxMessage()
    {
        return $this->nbPointsInboxMessage;
    }

    /**
     * Set nbPointsForOneStar
     *
     * @param integer $nbPointsForOneStar
     * @return Seuil
     */
    public function setNbPointsForOneStar($nbPointsForOneStar)
    {
        $this->nbPointsForOneStar = $nbPointsForOneStar;

        return $this;
    }

    /**
     * Get nbPointsForOneStar
     *
     * @return integer 
     */
    public function getNbPointsForOneStar()
    {
        return $this->nbPointsForOneStar;
    }

    /**
     * Set period
     *
     * @param integer $period
     * @return Seuil
     */
    public function setPeriod($period)
    {
        $this->period = $period;

        return $this;
    }

    /**
     * Get period
     *
     * @return integer 
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Set nbPointsPerImage
     *
     * @param integer $nbPointsPerImage
     * @return Seuil
     */
    public function setNbPointsPerImage($nbPointsPerImage)
    {
        $this->nbPointsPerImage = $nbPointsPerImage;

        return $this;
    }

    /**
     * Get nbPointsPerImage
     *
     * @return integer 
     */
    public function getNbPointsPerImage()
    {
        return $this->nbPointsPerImage;
    }
}
