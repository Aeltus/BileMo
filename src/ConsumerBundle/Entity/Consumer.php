<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/06/17
 * Time: 19:07
 */
namespace ConsumerBundle\Entity;

use AppBundle\Model\Entity\UserTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Brand;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * @ORM\Table(name="consumer")
 * @ORM\Entity(repositoryClass="ConsumerBundle\Repository\ConsumerRepository")
 *
 * @ExclusionPolicy("all")
 */
class Consumer
{
    use UserTrait;

    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Expose
     */
    private $id;

    /**
     * @ORM\Column(name="society_name", type="string", nullable=false, length=100, unique=true)
     *
     * @Expose
     */
    private $societyName;

    /**
     * @ORM\Column(name="payment_delay", type="string")
     *
     * @Expose
     */
    private $paymentsDelay;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Brand", orphanRemoval=true)
     * @ORM\JoinColumn(nullable=true)
     *
     * @Expose
     */
    private $brands;

    public function __construct()
    {
        $this->brands = new ArrayCollection();
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
    public function getSocietyName()
    {
        return $this->societyName;
    }

    /**
     * @return mixed
     */
    public function getPaymentsDelay()
    {
        return $this->paymentsDelay;
    }

    /**
     * @return mixed
     */
    public function getBrands()
    {
        return $this->brands;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $societyName
     */
    public function setSocietyName($societyName)
    {
        $this->societyName = $societyName;
    }

    /**
     * @param mixed $paymentsDelay
     */
    public function setPaymentsDelay($paymentsDelay)
    {
        $this->paymentsDelay = $paymentsDelay;
    }

    public function addBrand(Brand $brand)
    {
        $this->brands[] = $brand;
    }

    public function removeBrand(Brand $brand)
    {
        $this->brands->removeElement($brand);
    }
}
