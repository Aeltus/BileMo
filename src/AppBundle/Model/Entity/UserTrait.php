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
use Symfony\Component\Validator\Constraints as Assert;

Trait UserTrait
{
    /**
     * @ORM\Column(name="name", type="string", nullable=false, length=100)
     *
     * @Assert\NotBlank(message="Ce champ ne devrait pas être vide")
     * @Assert\Type("string", message="Ce champ attend une chaine de caractères")
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $name;

    /**
     * @ORM\Column(name="surname", type="string", nullable=false, length=100)
     *
     * @Assert\NotBlank(message="Ce champ ne devrait pas être vide")
     * @Assert\Type("string", message="Ce champ attend une chaine de caractères")
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $surname;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Address", cascade={"persist"})
     *
     * @Assert\Valid
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $billingAddress;

    /**
     * @ORM\Column(name="phone", type="string", nullable=true, length=12)
     *
     * @Assert\Type("string", message="Ce champ attend une chaine de caractères")
     * @Assert\Length(
     *      min = 0,
     *      max = 12,
     *      minMessage = "Ce champ comporte {{ value }} et devrait comporter au minimum {{ limit }} caractères.",
     *      maxMessage = "Ce champ comporte {{ value }} et devrait comporter au maximum {{ limit }} caractères."
     * )
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $phone = NULL;

    /**
     * @ORM\Column(name="cell_phone", type="string", nullable=true, length=12)
     *
     * @Assert\Type("string", message="Ce champ attend une chaine de caractères")
     * @Assert\Length(
     *      min = 0,
     *      max = 12,
     *      minMessage = "Ce champ comporte {{ value }} et devrait comporter au minimum {{ limit }} caractères.",
     *      maxMessage = "Ce champ comporte {{ value }} et devrait comporter au maximum {{ limit }} caractères."
     * )
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $cellPhone = NULL;

    /**
     * @ORM\Column(name="mail", type="string", nullable=false, length=100)
     *
     * @Assert\Email(
     *     message = "Cet Email : '{{ value }}' n\'est pas un email valide.",
     *     checkMX = true
     * )
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $mail;

    /**
     * @ORM\Column(name="is_available", type="boolean", nullable=false)
     *
     * @Assert\NotBlank(message="Ce champ ne devrait pas être vide")
     * @Assert\Type("bool", message="Ce champ attend un booleen")
     *
     * @Serializer\Since("1.0")
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
        return $this;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @param mixed $billingAddress
     */
    public function setBillingAddress(Address $billingAddress)
    {
        $this->billingAddress = $billingAddress;
        return $this;
    }

    /**
     * @param null $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @param null $cellPhone
     */
    public function setCellPhone($cellPhone)
    {
        $this->cellPhone = $cellPhone;
        return $this;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
        return $this;
    }

    /**
     * @param bool $isAvailable
     */
    public function setIsAvailable($isAvailable)
    {
        $this->isAvailable = $isAvailable;
        return $this;
    }

}
