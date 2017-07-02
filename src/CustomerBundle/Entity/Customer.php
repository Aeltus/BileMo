<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/06/17
 * Time: 19:00
 */
namespace CustomerBundle\Entity;

use AppBundle\Entity\UserTrait;
use Doctrine\Common\Collections\ArrayCollection;

class Customer
{
    use UserTrait;

    private $id;

    private $password;

    private $salt;

    private $isChecked;

    private $deliveryAddresses;

    private $consumer;

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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getSalt()
    {
        return $this->salt;
    }

    public function isChecked()
    {
        return $this->isChecked;
    }

    /**
     * @return mixed
     */
    public function getDeliveryAddresses()
    {
        return $this->deliveryAddresses;
    }

    /**
     * @return mixed
     */
    public function getConsumer()
    {
        return $this->consumer;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param mixed $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * @param mixed $isChecked
     */
    public function setIsChecked($isChecked)
    {
        $this->isChecked = $isChecked;
    }

    /**
     * @param mixed $consumer
     */
    public function setConsumer(Consumer $consumer)
    {
        $this->consumer = $consumer;
    }

    public function addDeliveryAddress(Address $address)
    {
        $this->deliveryAddresses[] = $address;
    }

    public function removeDeliveryAddress(Address $address)
    {
        $this->deliveryAddresses->removeElement($address);
    }

}