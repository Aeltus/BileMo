<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/06/17
 * Time: 19:07
 */
namespace ConsumerBundle\Entity;

use AppBundle\Model\Entity\UserTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Brand;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="consumer")
 * @ORM\Entity(repositoryClass="ConsumerBundle\Repository\ConsumerRepository")
 *
 * @ExclusionPolicy("all")
 */
class Consumer implements UserInterface
{
    use UserTrait;

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
     * @ORM\Column(name="society_name", type="string", nullable=false, length=100, unique=true)
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $societyName;

    /**
     * @ORM\Column(name="payment_delay", type="string")
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $paymentsDelay;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Brand", orphanRemoval=true, cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     *
     * @Serializer\Since("1.0")
     * @Expose
     */
    private $brands;

    /**
     * @ORM\Column(name="facebook_id", type="string", nullable=true, unique=true)
     */
    private $facebookId;

    public function __construct()
    {
        $this->brands = new ArrayCollection();
    }

    public function getUsername()
    {
        return $this->mail;
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }


    public function getPassword()
    {
    }

    public function getSalt()
    {
    }

    public function eraseCredentials()
    {
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
    public function getSocietyName()
    {
        return $this->societyName;
    }

    /**
     * @return mixed
     */
    public function getPaymentsDelay()
    {
        return $this->paymentsDelay;
    }

    /**
     * @return mixed
     */
    public function getBrands()
    {
        return $this->brands;
    }

    /**
     * @return mixed
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $societyName
     */
    public function setSocietyName($societyName)
    {
        $this->societyName = $societyName;
    }

    /**
     * @param mixed $paymentsDelay
     */
    public function setPaymentsDelay($paymentsDelay)
    {
        $this->paymentsDelay = $paymentsDelay;
    }

    public function addBrand(Brand $brand)
    {
        $this->brands[] = $brand;
    }

    public function removeBrand(Brand $brand)
    {
        $this->brands->removeElement($brand);
    }

    /**
     * @param mixed $facebookId
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
    }
}
