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

class ParticularProduct extends Product
{
    private $id;

    private $memory;

    private $memoryUnit;

    private $colorName;

    private $colorThumbnail;

    private $pictures = [];

    private $features = [];

    private $price;

    private $vat;

    private $stock;

    private $isAvailable = false;

    private $availabilityDate;

    private $isDefault = False;

    public function getId()
    {
        return $this->id;
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

    public function setId($id)
    {
        $this->id=$id;
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

}
