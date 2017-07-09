<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 05/06/17
 * Time: 19:18
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"product" = "Product", "particularProduct" = "ParticularProduct"})
 */
class Product
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", nullable=false, length=100)
     *
     */
    private $name;

    /**
     * @ORM\Column(name="description", type="string", nullable=false)
     *
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Brand")
     *
     */
    private $brand;

    /**
     * @ORM\Column(name="camera_resolution", type="float", nullable=false)
     *
     */
    private $cameraResolution;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Os")
     *
     */
    private $os;

    /**
     * @ORM\Column(name="screen_size", type="float", nullable=false)
     *
     */
    private $screenSize;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Rate")
     *
     */
    private $rate;

    /**
     * @ORM\Column(name="sar", type="float", nullable=false)
     *
     */
    private $sar;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SimCard")
     *
     */
    private $simCard;

    /**
     * @ORM\Column(name="is_tactile", type="boolean", nullable=false)
     *
     */
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
