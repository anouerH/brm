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

    /**
    * @ORM\ManyToOne(targetEntity="Star\AnnoncesBundle\Entity\Brand")
    * @ORM\JoinColumn(nullable=true)
    */
    private $brand;

    /**
    * @ORM\ManyToOne(targetEntity="Star\AnnoncesBundle\Entity\Model")
    * @ORM\JoinColumn(nullable=true)
    */
    private $model;

    /**
    * @ORM\ManyToOne(targetEntity="Star\AnnoncesBundle\Entity\Energy")
    * @ORM\JoinColumn(nullable=true)
    */
    private $energy;
        
    /**
     * @var string
     *
     * @ORM\Column(name="power", type="string", length=255,  nullable=true)
     */
    private $power;
    
    /**
     * @var string
     *
     * @ORM\Column(name="mileage", type="string", length=255 ,nullable=true)
     */
    private $mileage;
    
    /**
     * @var string
     *
     * @ORM\Column(name="total_area", type="string", length=255 ,nullable=true)
     */
    private $totalArea;
    
    /**
     * @var string
     *
     * @ORM\Column(name="living_area", type="string", length=255 ,nullable=true)
     */
    private $livingArea;
    
    /**
     * @var string
     *
     * @ORM\Column(name="number_rooms", type="string", length=255 ,nullable=true)
     */
    private $numberRooms;
    
    /**
     * @var string
     *
     * @ORM\Column(name="number_bathrooms", type="string", length=255 ,nullable=true)
     */
    private $numberBathRooms;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="parcking_places", type="string", length=255 ,nullable=true)
     */
    private $parckingPlaces;
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="construction_year", type="integer", nullable=true)
     */
    private $constructionYear;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="floor_number", type="integer", nullable=true)
     */
    private $floorNumber;
        
    /**
     * @var \Date
     *
     * @ORM\Column(name="releasedate", type="date", nullable=true)
     */
    private $release;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="fixed_price", type="integer", nullable=true)
     */
    private $fixedPrice;
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="show_phone_number", type="integer", nullable=true)
     */
    private $showPhoneNumber;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="convert_stars", type="integer", nullable=true)
     */
    private $convertStars;
    
    
    
    public function __construct()
    {
        $this->createdAt = new \Datetime();
        $this->imgDirId  = intval(sprintf('%09d', mt_rand(0, 1999999999)));
        $this->annonceType = 'OFFRE';  
        $this->demandeType = 'VENTE';
        $this->fixedPrice = 1;
        $this->showPhoneNumber = 0;
        $this->convertStars = 0;
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

    /**
     * Set brand
     *
     * @param \Star\AnnoncesBundle\Entity\Brand $brand
     * @return Annonce
     */
    public function setBrand(\Star\AnnoncesBundle\Entity\Brand $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \Star\AnnoncesBundle\Entity\Brand 
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set model
     *
     * @param \Star\AnnoncesBundle\Entity\Model $model
     * @return Annonce
     */
    public function setModel(\Star\AnnoncesBundle\Entity\Model $model = null)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return \Star\AnnoncesBundle\Entity\Model 
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set energy
     *
     * @param \Star\AnnoncesBundle\Entity\Energy $energy
     * @return Annonce
     */
    public function setEnergy(\Star\AnnoncesBundle\Entity\Energy $energy = null)
    {
        $this->energy = $energy;

        return $this;
    }

    /**
     * Get energy
     *
     * @return \Star\AnnoncesBundle\Entity\Energy 
     */
    public function getEnergy()
    {
        return $this->energy;
    }

    /**
     * Set power
     *
     * @param string $power
     * @return Annonce
     */
    public function setPower($power)
    {
        $this->power = $power;

        return $this;
    }

    /**
     * Get power
     *
     * @return string 
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * Set mileage
     *
     * @param string $mileage
     * @return Annonce
     */
    public function setMileage($mileage)
    {
        $this->mileage = $mileage;

        return $this;
    }

    /**
     * Get mileage
     *
     * @return string 
     */
    public function getMileage()
    {
        return $this->mileage;
    }

    /**
     * Set release
     *
     * @param \DateTime $release
     * @return Annonce
     */
    public function setRelease($release)
    {
        $this->release = $release;

        return $this;
    }

    /**
     * Get release
     *
     * @return \DateTime 
     */
    public function getRelease()
    {
        return $this->release;
    }

    /**
     * Set totalArea
     *
     * @param string $totalArea
     * @return Annonce
     */
    public function setTotalArea($totalArea)
    {
        $this->totalArea = $totalArea;

        return $this;
    }

    /**
     * Get totalArea
     *
     * @return string 
     */
    public function getTotalArea()
    {
        return $this->totalArea;
    }

    /**
     * Set livingArea
     *
     * @param string $livingArea
     * @return Annonce
     */
    public function setLivingArea($livingArea)
    {
        $this->livingArea = $livingArea;

        return $this;
    }

    /**
     * Get livingArea
     *
     * @return string 
     */
    public function getLivingArea()
    {
        return $this->livingArea;
    }

    /**
     * Set numberRooms
     *
     * @param string $numberRooms
     * @return Annonce
     */
    public function setNumberRooms($numberRooms)
    {
        $this->numberRooms = $numberRooms;

        return $this;
    }

    /**
     * Get numberRooms
     *
     * @return string 
     */
    public function getNumberRooms()
    {
        return $this->numberRooms;
    }

    /**
     * Set numberBathRooms
     *
     * @param string $numberBathRooms
     * @return Annonce
     */
    public function setNumberBathRooms($numberBathRooms)
    {
        $this->numberBathRooms = $numberBathRooms;

        return $this;
    }

    /**
     * Get numberBathRooms
     *
     * @return string 
     */
    public function getNumberBathRooms()
    {
        return $this->numberBathRooms;
    }

    /**
     * Set parckingPlaces
     *
     * @param string $parckingPlaces
     * @return Annonce
     */
    public function setParckingPlaces($parckingPlaces)
    {
        $this->parckingPlaces = $parckingPlaces;

        return $this;
    }

    /**
     * Get parckingPlaces
     *
     * @return string 
     */
    public function getParckingPlaces()
    {
        return $this->parckingPlaces;
    }

    /**
     * Set constructionYear
     *
     * @param integer $constructionYear
     * @return Annonce
     */
    public function setConstructionYear($constructionYear)
    {
        $this->constructionYear = $constructionYear;

        return $this;
    }

    /**
     * Get constructionYear
     *
     * @return integer 
     */
    public function getConstructionYear()
    {
        return $this->constructionYear;
    }

    /**
     * Set floorNumber
     *
     * @param integer $floorNumber
     * @return Annonce
     */
    public function setFloorNumber($floorNumber)
    {
        $this->floorNumber = $floorNumber;

        return $this;
    }

    /**
     * Get floorNumber
     *
     * @return integer 
     */
    public function getFloorNumber()
    {
        return $this->floorNumber;
    }

    /**
     * Set fixedPrice
     *
     * @param integer $fixedPrice
     * @return Annonce
     */
    public function setFixedPrice($fixedPrice)
    {
        $this->fixedPrice = $fixedPrice;

        return $this;
    }

    /**
     * Get fixedPrice
     *
     * @return integer 
     */
    public function getFixedPrice()
    {
        return $this->fixedPrice;
    }

    /**
     * Set showPhoneNumber
     *
     * @param integer $showPhoneNumber
     * @return Annonce
     */
    public function setShowPhoneNumber($showPhoneNumber)
    {
        $this->showPhoneNumber = $showPhoneNumber;

        return $this;
    }

    /**
     * Get showPhoneNumber
     *
     * @return integer 
     */
    public function getShowPhoneNumber()
    {
        return $this->showPhoneNumber;
    }

    /**
     * Set convertStars
     *
     * @param integer $convertStars
     * @return Annonce
     */
    public function setConvertStars($convertStars)
    {
        $this->convertStars = $convertStars;

        return $this;
    }

    /**
     * Get convertStars
     *
     * @return integer 
     */
    public function getConvertStars()
    {
        return $this->convertStars;
    }
}
