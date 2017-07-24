<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/06/17
 * Time: 19:24
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="address")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AddressRepository")
 *
 * @ExclusionPolicy("all")
 */
class Address
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
     * @ORM\Column(name="address1", type="string", nullable=false, length=100)
     *
     * @Assert\NotBlank(message="ce champ doit être renseigné")
     * @Assert\Type("string", message="Ce champ attend une chaine de caractères")
     * @Assert\Length(
     *      min = 3,
     *      max = 100,
     *      minMessage = "Ce champ devrait comporter au minimum {{ limit }} caractères.",
     *      maxMessage = "Ce champ devrait comporter au maximum {{ limit }} caractères."
     * )
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $address1;

    /**
     * @ORM\Column(name="address2", type="string", nullable=true, length=100)
     *
     * @Assert\Type("string", message="Ce champ attend une chaine de caractères")
     * @Assert\Length(
     *      min = 3,
     *      max = 100,
     *      minMessage = "Ce champ devrait comporter au minimum {{ limit }} caractères.",
     *      maxMessage = "Ce champ devrait comporter au maximum {{ limit }} caractères."
     * )
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $address2;

    /**
     * @ORM\Column(name="address3", type="string", nullable=true, length=100)
     *
     * @Assert\Type("string", message="Ce champ attend une chaine de caractères")
     * @Assert\Length(
     *      min = 3,
     *      max = 100,
     *      minMessage = "Ce champ devrait comporter au minimum {{ limit }} caractères.",
     *      maxMessage = "Ce champ devrait comporter au maximum {{ limit }} caractères."
     * )
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $address3;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\City")
     *
     * @Assert\Valid
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $city;

    /**
     * @ORM\Column(name="is_available", type="boolean", nullable=false)
     *
     * @Assert\NotBlank(message="ce champ doit être renseigné")
     * @Assert\Type("bool", message="Ce champ attend un booleen")
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $isAvailable;

    /**
     * @ORM\Column(name="is_default", type="boolean", nullable=false)
     *
     * @Assert\NotBlank(message="ce champ doit être renseigné")
     * @Assert\Type("bool", message="Ce champ attend un booleen")
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $isDefault;

    /**
     * @ORM\ManyToOne(targetEntity="CustomerBundle\Entity\Customer", inversedBy="deliveryAddresses")
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $customerAddress = NULL;

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
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * @return mixed
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @return mixed
     */
    public function getAddress3()
    {
        return $this->address3;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    public function isAvailable()
    {
        return $this->isAvailable;
    }

    public function isDefault()
    {
        return $this->isDefault;
    }

    /**
     * @return mixed
     */
    public function getCustomerAddress()
    {
        return $this->customerAddress;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $address1
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;
    }

    /**
     * @param mixed $address2
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
    }

    /**
     * @param mixed $address3
     */
    public function setAddress3($address3)
    {
        $this->address3 = $address3;
    }

    /**
     * @param mixed $city
     */
    public function setCity(City $city)
    {
        $this->city = $city;
    }

    /**
     * @param mixed $isAvailable
     */
    public function setIsAvailable($isAvailable)
    {
        $this->isAvailable = $isAvailable;
    }

    /**
     * @param mixed $isDefault
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;
    }

    /**
     * @param mixed $customerAddress
     */
    public function setCustomerAddress($customerAddress)
    {
        $this->customerAddress = $customerAddress;
    }

}
