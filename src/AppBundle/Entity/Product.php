<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 05/06/17
 * Time: 19:18
 */
namespace AppBundle\Entity;

class Product
{
    private $id;

    private $name;

    private $description;

    private $brand;

    private $cameraResolution;

    private $os;

    private $screenSize;

    private $rate;

    private $sar;

    private $simCard;

    private $isTactile;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @return mixed
     */
    public function getCameraResolution()
    {
        return $this->cameraResolution;
    }

    /**
     * @return mixed
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * @return mixed
     */
    public function getScreenSize()
    {
        return $this->screenSize;
    }

    /**
     * @return mixed
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @return mixed
     */
    public function getSar()
    {
        return $this->sar;
    }

    /**
     * @return mixed
     */
    public function getSimCard()
    {
        return $this->simCard;
    }

    /**
     * @return bool
     */
    public function isTactile()
    {
        return $this->isTactile;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @param mixed $cameraResolution
     */
    public function setCameraResolution($cameraResolution)
    {
        $this->cameraResolution = $cameraResolution;
    }

    /**
     * @param mixed $os
     */
    public function setOs($os)
    {
        $this->os = $os;
    }

    /**
     * @param mixed $screenSize
     */
    public function setScreenSize($screenSize)
    {
        $this->screenSize = $screenSize;
    }

    /**
     * @param mixed $rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    }

    /**
     * @param mixed $sar
     */
    public function setSar($sar)
    {
        $this->sar = $sar;
    }

    /**
     * @param mixed $simCard
     */
    public function setSimCard($simCard)
    {
        $this->simCard = $simCard;
    }

    /**
     * @param mixed $isTactile
     */
    public function setIsTactile($isTactile)
    {
        $this->isTactile = $isTactile;
    }

}
