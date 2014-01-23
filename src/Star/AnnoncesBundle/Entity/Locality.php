<?php

namespace Star\AnnoncesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Locality
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Star\AnnoncesBundle\Entity\LocalityRepository")
 */
class Locality
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
    * @ORM\ManyToOne(targetEntity="Star\AnnoncesBundle\Entity\Deleg")
    * @ORM\JoinColumn(nullable=false)
    */
    private $deleg;

    public function __construct()
    {
        $this->createdAt = new \Datetime();
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

    /**
     * Set name
     *
     * @param string $name
     * @return Locality
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Locality
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Locality
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set deleg
     *
     * @param \Star\AnnoncesBundle\Entity\Deleg $deleg
     * @return Locality
     */
    public function setDeleg(\Star\AnnoncesBundle\Entity\Deleg $deleg)
    {
        $this->deleg = $deleg;

        return $this;
    }

    /**
     * Get deleg
     *
     * @return \Star\AnnoncesBundle\Entity\Deleg 
     */
    public function getDeleg()
    {
        return $this->deleg;
    }
}
