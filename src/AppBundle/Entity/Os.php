<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 05/06/17
 * Time: 19:28
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 *
 * @ORM\Table(name="os")
 * @ORM\Entity(repositoryClass="BileMo\AppBundle\Repository\OsRepository")
 *
 * @ExclusionPolicy("all")
 */
class Os
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
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
