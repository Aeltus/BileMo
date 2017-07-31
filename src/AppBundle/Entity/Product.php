<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 05/06/17
 * Time: 19:18
 */
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Hateoas\Configuration\Annotation as Hateoas;

/**
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"product" = "Product", "particularProduct" = "ParticularProduct"})
 *
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "app_articles_show_one",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      ),
 *     exclusion = @Hateoas\Exclusion(
 *          excludeIf = "expr(object.isInstanceOfParticularProduct() === true)"
 *      )
 * )
 *
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "app_detailed_articles_show_one",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      ),
 *     exclusion = @Hateoas\Exclusion(
 *          excludeIf = "expr(object.isInstanceOfParticularProduct() === false)"
 *      )
 * )
 *
 * @Hateoas\Relation(
 *      "index",
 *      href = @Hateoas\Route(
 *          "app_articles_show",
 *          absolute = true
 *      )
 * )
 *
 * @Hateoas\Relation(
 *     "detailed_products",
 *     embedded = @Hateoas\Embedded("expr(object.getLinked())"),
 *     exclusion = @Hateoas\Exclusion(
 *          excludeIf = "expr(object.isInstanceOfParticularProduct() === true)"
 *      )
 * )
 *
 * @ExclusionPolicy("all")
 */
class Product
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", nullable=false, length=100)
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $name;

    /**
     * @ORM\Column(name="description", type="string", nullable=false)
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Brand")
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $brand;

    /**
     * @ORM\Column(name="camera_resolution", type="float", nullable=false)
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $cameraResolution;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Os")
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $os;

    /**
     * @ORM\Column(name="screen_size", type="float", nullable=false)
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $screenSize;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Rate")
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $rate;

    /**
     * @ORM\Column(name="sar", type="float", nullable=false)
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $sar;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SimCard")
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $simCard;

    /**
     * @ORM\Column(name="is_tactile", type="boolean", nullable=false)
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $isTactile;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ParticularProduct", mappedBy="product", orphanRemoval=true)
     * @ORM\JoinColumn(nullable=true)
     */
    private $linked;

    /**
     * @ORM\Column(name="is_available", type="boolean", nullable=false)
     * @Serializer\Since("1.0")
     *
     */
    private $isAvailable = false;

    /**
     * @ORM\Column(name="availabitity_date", type="datetime", nullable=false)
     * @Serializer\Since("1.0")
     *
     */
    private $availabilityDate;

    public function __construct()
    {
        $this->linked = new ArrayCollection();
        $this->availabilityDate = new \DateTime();
    }

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
     * @return mixed
     */
    public function getLinked()
    {
        return $this->linked;
    }

    public function isAvailable()
    {
        return $this->isAvailable;
    }

    /**
     * @return mixed
     */
    public function getAvailabilityDate()
    {
        return $this->availabilityDate;
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

    public function addLinked($linked)
    {
        $this->linked[] = $linked;
    }

    /**
     * @param mixed $isAvailable
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

    public function removeLinked($linked)
    {
        $this->linked->removeElement($linked);
    }

    public function isInstanceOfParticularProduct()
    {
        if($this instanceof ParticularProduct)
        {
            return true;
        }
        return false;
    }
}
