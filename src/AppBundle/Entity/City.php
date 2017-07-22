<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/06/17
 * Time: 19:22
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="city")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CityRepository")
 *
 * @ExclusionPolicy("all")
 */
class City
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
     * @ORM\Column(name="name", type="string", nullable=false, unique=true)
     *
     * @Assert\NotBlank(message="ce champ doit être renseigné")
     * @Assert\Type("alpha", message="Ce champ attend une chaine de caractères")
     * @Assert\Length(
     *      min = 2,
     *      max = 20,
     *      minMessage = "Ce champ devrait comporter au minimum {{ limit }} caractères.",
     *      maxMessage = "Ce champ devrait comporter au maximum {{ limit }} caractères."
     * )
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $name;

    /**
     * @ORM\Column(name="zip_code", type="string", nullable=false, unique=true, length=5)
     *
     * @Assert\NotBlank(message="ce champ doit être renseigné")
     * @Assert\Type("string", message="Ce champ attend une chaine de caractères")
     * @Assert\Length(
     *      min = 3,
     *      max = 5,
     *      minMessage = "Ce champ devrait comporter au minimum {{ limit }} caractères.",
     *      maxMessage = "Ce champ devrait comporter au maximum {{ limit }} caractères."
     * )
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $zipCode;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Country")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Assert\Valid
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $country;

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
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
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
     * @param mixed $country
     */
    public function setCountry(Country $country)
    {
        $this->country = $country;
    }

    /**
     * @param mixed $zipCode
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }
}
