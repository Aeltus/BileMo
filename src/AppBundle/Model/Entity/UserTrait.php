<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/06/17
 * Time: 18:53
 */
namespace AppBundle\Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use AppBundle\Entity\Address;

Trait UserTrait
{
    /**
     * @ORM\Column(name="name", type="string", nullable=false, length=100)
     *
     * @Expose
     */
    private $name;

    /**
     * @ORM\Column(name="surname", type="string", nullable=false, length=100)
     *
     * @Expose
     */
    private $surname;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Address")
     *
     * @Expose
     */
    private $billingAddress;

    /**
     * @ORM\Column(name="phone", type="string", nullable=true, length=10, unique=true)
     *
     * @Expose
     */
    private $phone = NULL;

    /**
     * @ORM\Column(name="cell_phone", type="string", nullable=true, length=10, unique=true)
     *
     * @Expose
     */
    private $cellPhone = NULL;

    /**
     * @ORM\Column(name="mail", type="string", nullable=false, length=100, unique=true)
     *
     * @Expose
     */
    private $mail;

    /**
     * @ORM\Column(name="is_available", type="boolean", nullable=false)
     *
     * @Expose
     */
    private $isAvailable = True;

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
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @return mixed
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * @return null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return null
     */
    public function getCellPhone()
    {
        return $this->cellPhone;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @return bool
     */
    public function isAvailable()
    {
        return $this->isAvailable;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @param mixed $billingAddress
     */
    public function setBillingAddress(Address $billingAddress)
    {
        $this->billingAddress = $billingAddress;
    }

    /**
     * @param null $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @param null $cellPhone
     */
    public function setCellPhone($cellPhone)
    {
        $this->cellPhone = $cellPhone;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @param bool $isAvailable
     */
    public function setIsAvailable($isAvailable)
    {
        $this->isAvailable = $isAvailable;
    }

}
