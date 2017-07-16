<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 14/07/17
 * Time: 10:56
 */
namespace Consumer\DataFixtures\ORM;

use AppBundle\Entity\City;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCityData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $city = new City();
        $city->setName('Carcassonne');
        $city->setZipCode('11000');
        $city->setCountry($this->getReference('France'));
        $manager->persist($city);

        $city2 = new City();
        $city2->setName('Mirepoix');
        $city2->setZipCode('09500');
        $city2->setCountry($this->getReference('France'));

        $manager->persist($city2);

        $manager->flush();
        $this->addReference($city->getName(), $city);
        $this->addReference($city2->getName(), $city2);
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 8;
    }
}

