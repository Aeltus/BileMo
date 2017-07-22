<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/06/17
 * Time: 19:21
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="country")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CountryRepository")
 *
 * @ExclusionPolicy("all")
 */
class Country
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
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $country
     */
    public function setName($name)
    {
        $this->name = $name;
    }

}
