<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/06/17
 * Time: 19:00
 */
namespace CustomerBundle\Entity;

use AppBundle\Model\Entity\UserTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ConsumerBundle\Entity\Consumer;
use AppBundle\Entity\Address;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * @ORM\Table(name="customer")
 * @ORM\Entity(repositoryClass="CustomerBundle\Repository\CustomerRepository")
 *
 * @ExclusionPolicy("all")
 */
class Customer
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
     * @ORM\Column(name="password", type="string", nullable=false, length=100)
     *
     * @Expose
     */
    private $password;

    /**
     * @ORM\Column(name="salt", type="string", nullable=false, length=100)
     *
     * @Expose
     */
    private $salt;

    /**
     * @ORM\Column(name="is_checked", type="boolean", nullable=false)
     *
     * @Expose
     */
    private $isChecked;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Address", mappedBy="customerAddress", orphanRemoval=true)
     * @ORM\JoinColumn(nullable=false)
     */
    private $deliveryAddresses;

    /**
     * @ORM\OneToOne(targetEntity="ConsumerBundle\Entity\Consumer")
     *
     * @Expose
     */
    private $consumer;

    public function __construct()
    {
        $this->deliveryAddresses = new ArrayCollection();
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