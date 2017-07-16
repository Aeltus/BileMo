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
use Hateoas\Configuration\Annotation as Hateoas;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="customer")
 * @ORM\Entity(repositoryClass="CustomerBundle\Repository\CustomerRepository")
 *
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "customers_customers_show_one",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      )
 * )
 *
 * @Hateoas\Relation(
 *      "index",
 *      href = @Hateoas\Route(
 *          "customers_customers_show",
 *          absolute = true
 *      )
 * )
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
     * @Assert\NotBlank(message="Le mot de passe ne devrait pas être vide")
     * @Assert\Type("string", message="Ce champ attend une chaine de caractères")
     *
     * @Expose
     */
    private $password;

    /**
     * @ORM\Column(name="salt", type="string", nullable=false, length=100)
     *
     * @Assert\NotBlank(message="Le sel ne devrait pas être vide")
     * @Assert\Type("string", message="Ce champ attend une chaine de caractères")
     *
     * @Expose
     */
    private $salt;

    /**
     * @ORM\Column(name="is_checked", type="boolean", nullable=false)
     *
     * @Assert\NotBlank(message="Ce champ ne devrait pas être vide")
     * @Assert\Type("bool", message="Ce champ attend un booleen")
     *
     * @Expose
     */
    private $isChecked;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Address", mappedBy="customerAddress", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     *
     * @Assert\Valid
     *
     * @Expose
     */
    private $deliveryAddresses;

    /**
     * @ORM\ManyToOne(targetEntity="ConsumerBundle\Entity\Consumer", cascade={"persist"})
     *
     * @Assert\Valid
     *
     * @Expose
     */
    private $consumer;

    /**
     * @ORM\Column(name="consumer_key", type="string", nullable=true)
     * @Expose
     */
    private $consumerKey = 1;

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
     * @return mixed
     */
    public function getConsumerKey()
    {
        return $this->consumerKey;
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
    public function setConsumer(Consumer $consumer = NULL)
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

    /**
     * @param mixed $consumerKey
     */
    public function setConsumerKey($consumerKey)
    {
        $this->consumerKey = $consumerKey;
    }

    public function eraseBillingAddress()
    {
        $this->billingAddress = NULL;
    }

}