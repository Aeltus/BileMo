<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/06/17
 * Time: 18:40
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 *
 * @ORM\Table(name="feature")
 * @ORM\Entity(repositoryClass="BileMo\AppBundle\Repository\FeatureRepository")
 *
 * @ExclusionPolicy("all")
 */
class Feature
{

    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", nullable=false, unique=true)
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $name;

    /**
     * @ORM\Column(name="value", type="string", nullable=false, unique=false)
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ParticularProduct", inversedBy="features")
     *
     */
    private $particularProduct;

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
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getParticularProduct()
    {
        return $this->particularProduct;
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
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @param mixed $particularProduct
     */
    public function setParticularProduct(ParticularProduct $particularProduct)
    {
        $this->particularProduct = $particularProduct;
    }

}
