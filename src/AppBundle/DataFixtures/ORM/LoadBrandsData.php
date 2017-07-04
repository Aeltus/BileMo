<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 02/07/17
 * Time: 11:45
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Brand;

class LoadBrandsData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $brands =  ["Samsung", "Apple", "Wiko", "Sony", "Asus"];

        foreach ($brands as $brand)
        {
            $brandFixture = new Brand();
            $brandFixture->setName($brand);
            $manager->persist($brandFixture);
            $this->addReference($brand, $brandFixture);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }
}
