<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 05/06/17
 * Time: 19:31
 */
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Picture;
use AppBundle\Entity\Feature;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="particular_product")
 * @ORM\Entity(repositoryClass="BileMo\AppBundle\Repository\ParticularProductRepository")
 *
 */
class ParticularProduct extends Product
{
    /**
     * @ORM\Column(name="memory", type="integer", nullable=false)
     */
    private $memory;

    /**
     * @ORM\Column(name="memory_unit", type="string", nullable=false, length=10)
     *
     */
    private $memoryUnit;

    /**
     * @ORM\Column(name="color_name", type="string", nullable=false, length=100)
     *
     */
    private $colorName;

    /**
     * @ORM\Column(name="color_thumbnail", type="string", nullable=false, length=7)
     *
     */
    private $colorThumbnail;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Picture", orphanRemoval=true)
     * @ORM\JoinColumn(nullable=true)
     *
     */
    private $pictures;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Feature", mappedBy="particularProduct", orphanRemoval=true)
     * @ORM\JoinColumn(nullable=true)
     *
     */
    private $features;

    /**
     * @ORM\Column(name="price", type="float", nullable=false)
     *
     */
    private $price;

    /**
     * @ORM\Column(name="vat", type="float", nullable=false)
     *
     */
    private $vat;

    /**
     * @ORM\Column(name="stock", type="integer", nullable=false)
     *
     */
    private $stock;

    /**
     * @ORM\Column(name="is_available", type="boolean", nullable=false)
     *
     */
    private $isAvailable = false;

    /**
     * @ORM\Column(name="availabitity_date", type="datetime", nullable=false)
     *
     */
    private $availabilityDate;

    /**
     * @ORM\Column(name="is_default", type="boolean", nullable=false)
     *
     */
    private $isDefault = False;

    public function __construct()
    {
        $this->availabilityDate = new \DateTime();
        $this->pictures = new ArrayCollection();
        $this->features = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getMemory()
    {
        return $this->memory;
    }

    /**
     * @return mixed
     */
    public function getMemoryUnit()
    {
        return $this->memoryUnit;
    }

    /**
     * @return mixed
     */
    public function getColorName()
    {
        return $this->colorName;
    }

    /**
     * @return mixed
     */
    public function getColorThumbnail()
    {
        return $this->colorThumbnail;
    }

    /**
     * @return mixed
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * @return mixed
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    public function isAvailable()
    {
        return$this->isAvailable;
    }

    /**
     * @return mixed
     */
    public function getAvailabilityDate()
    {
        return $this->availabilityDate;
    }

    public function isDefault()
    {
        return $this->isDefault;
    }

    /**
     * @param mixed $memory
     */
    public function setMemory($memory)
    {
        $this->memory = $memory;
    }

    /**
     * @param mixed $memoryUnit
     */
    public function setMemoryUnit($memoryUnit)
    {
        $this->memoryUnit = $memoryUnit;
    }

    /**
     * @param mixed $colorName
     */
    public function setColorName($colorName)
    {
        $this->colorName = $colorName;
    }

    /**
     * @param mixed $colorThumbnail
     */
    public function setColorThumbnail($colorThumbnail)
    {
        $this->colorThumbnail = $colorThumbnail;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @param mixed $vat
     */
    public function setVat($vat)
    {
        $this->vat = $vat;
    }

    /**
     * @param mixed $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    /**
     * @param bool $isAvailable
     */
    public function setIsAvailable($isAvailable)
    {
        $this->isAvailable = $isAvailable;
    }

    /**
     * @param mixed $availabilityDate
     */
    public function setAvailabilityDate($availabilityDate)
    {
        $this->availabilityDate = $availabilityDate;
    }

    /**
     * @param bool $isDefault
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;
    }

    public function decreaseStock()
    {
        $this->stock = $this->stock--;
    }

    public function addPicture(Picture $picture)
    {
        $this->pictures[] = $picture;
    }

    public function removePicture(Picture $picture)
    {
        $this->pictures->removeElement($picture);
    }

    public function addFeature(Feature $feature)
    {
        $this->features[] = $feature;
    }

    public function removeFeature(Feature $feature)
    {
        $this->features->removeElement($feature);
    }
    
    /*===============
    Parents Getters and Setters ==================*/
    
    public function getId()
    {
        return parent::getId();
    }
    
    public function getName()
    {
        return parent::getName();
    }
    
    public function getDescription()
    {
        return parent::getDescription();
    }
    
    public function getBrand()
    {
        return parent::getBrand();
    }
    
    public function getCameraResolution()
    {
        return parent::getCameraResolution();
    }
    
    public function getScreenSize()
    {
        return parent::getScreenSize();
    }
    
    public function getRate()
    {
        return parent::getRate();
    }
    
    public function getSar()
    {
        return parent::getSar();
    }
    
    public function getSimCard()
    {
        return parent::getSimCard();
    }
    
    public function getOs()
    {
        return parent::getOs();
    }
    
    public function isTactile()
    {
        return parent::isTactile();
    }

    public function setId($id)
    {
        parent::setId($id);
    }

    public function setName($name)
    {
        parent::setName($name);
    }
    
    public function setDescription($description)
    {
        parent::setDescription($description);
    }
    
    public function setBrand($brand)
    {
        parent::setBrand($brand);
    }
    
    public function setCameraResolution($cameraResolution)
    {
        parent::setCameraResolution($cameraResolution);
    }
    
    public function setOs($os)
    {
        parent::setOs($os);
    }
    
    public function setScreenSize($screenSize)
    {
        parent::setScreenSize($screenSize);
    }
    
    public function setRate($rate)
    {
        parent::setRate($rate);
    }
    
    public function setSar($sar)
    {
        parent::setSar($sar);
    }
    
    public function setSimCard($simCard)
    {
        parent::setSimCard($simCard);
    }
    
    public function setIsTactile($isTactile)
    {
        parent::setIsTactile($isTactile);
    }

}
