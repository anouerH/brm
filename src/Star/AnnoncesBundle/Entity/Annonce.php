<?php

namespace Star\AnnoncesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * Annonce
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Star\AnnoncesBundle\Entity\AnnonceRepository")
 */
class Annonce
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal")
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="img_dir_id", type="integer")
     */
    private $imgDirId;

    /**
    * @Gedmo\Slug(fields={"title"})
    * @ORM\Column(length=128, unique=true)
    */
    private $slug;

    /**
    * @ORM\ManyToOne(targetEntity="Star\AnnoncesBundle\Entity\Gouv")
    * @ORM\JoinColumn(nullable=false)
    */
    private $gouv;

    /**
    * @ORM\ManyToOne(targetEntity="Star\AnnoncesBundle\Entity\Deleg")
    * @ORM\JoinColumn(nullable=false)
    */
    private $deleg;

    /**
    * @ORM\ManyToOne(targetEntity="Star\AnnoncesBundle\Entity\Locality")
    * @ORM\JoinColumn(nullable=false)
    */
    private $locality;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="annonce_type", type="string", length=45)
     */
    private $annonceType;

    /**
     * @var string
     *
     * @ORM\Column(name="demande_type", type="string", length=45)
     */
    private $demandeType;

    /**
    * @ORM\ManyToOne(targetEntity="Star\UserBundle\Entity\User")
    * @ORM\JoinColumn(nullable=false)
    */
    private $user;

    /**
    * @ORM\ManyToOne(targetEntity="Star\AnnoncesBundle\Entity\Theme")
    * @ORM\JoinColumn(nullable=false)
    */
    private $theme;

    /**
    * @ORM\ManyToOne(targetEntity="Star\AnnoncesBundle\Entity\Nature")
    * @ORM\JoinColumn(nullable=false)
    */
    private $nature;



    public function __construct()
    {
        $this->createdAt = new \Datetime();
        $this->imgDirId  = intval(sprintf('%09d', mt_rand(0, 1999999999)));
        $this->annonceType = 'OFFRE';  
        $this->demandeType = 'VENTE';  
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
     * Set title
     *
     * @param string $title
     * @return Annonce
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Annonce
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Annonce
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Annonce
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
     * @return Annonce
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
     * Set imgDirId
     *
     * @param integer $imgDirId
     * @return Annonce
     */
    public function setImgDirId($imgDirId)
    {
        $this->imgDirId = $imgDirId;

        return $this;
    }

    /**
     * Get imgDirId
     *
     * @return integer 
     */
    public function getImgDirId()
    {
        return $this->imgDirId;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Annonce
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set gouv
     *
     * @param \Star\AnnoncesBundle\Entity\Gouv $gouv
     * @return Annonce
     */
    public function setGouv(\Star\AnnoncesBundle\Entity\Gouv $gouv)
    {
        $this->gouv = $gouv;

        return $this;
    }

    /**
     * Get gouv
     *
     * @return \Star\AnnoncesBundle\Entity\Gouv 
     */
    public function getGouv()
    {
        return $this->gouv;
    }

    /**
     * Set deleg
     *
     * @param \Star\AnnoncesBundle\Entity\Deleg $deleg
     * @return Annonce
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

    /**
     * Set locality
     *
     * @param \Star\AnnoncesBundle\Entity\Locality $locality
     * @return Annonce
     */
    public function setLocality(\Star\AnnoncesBundle\Entity\Locality $locality)
    {
        $this->locality = $locality;

        return $this;
    }

    /**
     * Get locality
     *
     * @return \Star\AnnoncesBundle\Entity\Locality 
     */
    public function getLocality()
    {
        return $this->locality;
    }

    /**
     * Set annonceType
     *
     * @param string $annonceType
     * @return Annonce
     */
    public function setAnnonceType($annonceType)
    {
        $this->annonceType = $annonceType;

        return $this;
    }

    /**
     * Get annonceType
     *
     * @return string 
     */
    public function getAnnonceType()
    {
        return $this->annonceType;
    }

    /**
     * Set demandeType
     *
     * @param string $demandeType
     * @return Annonce
     */
    public function setDemandeType($demandeType)
    {
        $this->demandeType = $demandeType;

        return $this;
    }

    /**
     * Get demandeType
     *
     * @return string 
     */
    public function getDemandeType()
    {
        return $this->demandeType;
    }

    /**
     * Set user
     *
     * @param \Star\UserBundle\Entity\User $user
     * @return Annonce
     */
    public function setUser(\Star\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Star\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set theme
     *
     * @param \Star\AnnoncesBundle\Entity\Theme $theme
     * @return Annonce
     */
    public function setTheme(\Star\AnnoncesBundle\Entity\Theme $theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \Star\AnnoncesBundle\Entity\Theme 
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set nature
     *
     * @param \Star\AnnoncesBundle\Entity\Nature $nature
     * @return Annonce
     */
    public function setNature(\Star\AnnoncesBundle\Entity\Nature $nature)
    {
        $this->nature = $nature;

        return $this;
    }

    /**
     * Get nature
     *
     * @return \Star\AnnoncesBundle\Entity\Nature 
     */
    public function getNature()
    {
        return $this->nature;
    }
}
