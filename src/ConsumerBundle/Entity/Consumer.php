<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/06/17
 * Time: 19:07
 */
namespace ConsumerBundle\Entity;

use AppBundle\Entity\UserTrait;
use Doctrine\Common\Collections\ArrayCollection;

class Consumer
{
    use UserTrait;

    private $id;

    private $societyName;

    private $paymentsDelay;

    private $brands;

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
