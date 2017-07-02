<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/06/17
 * Time: 18:50
 */
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\DateTime;

class Order
{

    private $id;

    private $products;

    private $customer;

    private $deliveryAddress;

    private $billingAddress;

    private $soldAt;

    private $isWaitingForCustomerPayment = True;

    private $isWaitingForConsumerPayment = True;

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
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @return mixed
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * @return mixed
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * @return mixed
     */
    public function soldAt()
    {
        return $this->soldAt;
    }

    public function isWaitingForCustomerPayement()
    {
        return $this->isWaitingForCustomerPayment;
    }

    public function isWaitingForConsumerPayment()
    {
        return $this->isWaitingForConsumerPayment;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $customer
     */
    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @param mixed $deliveryAddress
     */
    public function setDeliveryAddress(Address $deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    /**
     * @param mixed $billingAddress
     */
    public function setBillingAddress(Address $billingAddress)
    {
        $this->billingAddress = $billingAddress;
    }

    /**
     * @param mixed $soldAt
     */
    public function setSoldAt(DateTime $soldAt)
    {
        $this->soldAt = $soldAt;
    }

    /**
     * @param bool $isWaitingForConsumerPayment
     */
    public function setIsWaitingForConsumerPayment($isWaitingForConsumerPayment)
    {
        $this->isWaitingForConsumerPayment = $isWaitingForConsumerPayment;
    }

    /**
     * @param bool $isWaitingForCustomerPayment
     */
    public function setIsWaitingForCustomerPayment($isWaitingForCustomerPayment)
    {
        $this->isWaitingForCustomerPayment = $isWaitingForCustomerPayment;
    }

    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    public function removeProduct(Product $product)
    {
        $this->products->removeElement($product);
    }

}
