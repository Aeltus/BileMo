<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 02/07/17
 * Time: 15:51
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Os;

class LoadOsData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $operatingSystems =  ["Android", "IOs", "Autre"];

        foreach ($operatingSystems as $os)
        {
            $osFixture = new Os();
            $osFixture->setName($os);
            $manager->persist($osFixture);
            $this->addReference($os, $osFixture);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 3;
    }
}

