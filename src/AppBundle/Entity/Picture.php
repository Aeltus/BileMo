<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/06/17
 * Time: 18:38
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 *
 * @ORM\Table(name="picture")
 * @ORM\Entity(repositoryClass="BileMo\AppBundle\Repository\PictureRepository")
 *
 * @ExclusionPolicy("all")
 */
class Picture
{

    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

    /**
     * @ORM\Column(name="url", type="string", nullable=false, unique=true)
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $url;

    /**
     * @ORM\Column(name="alt", type="string", nullable=false, unique=false, length=100)
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $alt;

    /**
     * @ORM\Column(name="is_default", type="boolean", nullable=false)
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $isDefault = False;

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
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    public function isDafault()
    {
        return $this->isDefault;
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
     * @param mixed $alt
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @param bool $isDefault
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;
    }

    /**
     * @param mixed $particularProduct
     */
    public function setParticularProduct(ParticularProduct $particularProduct)
    {
        $this->particularProduct = $particularProduct;
    }

}
