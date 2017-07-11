<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 02/07/17
 * Time: 14:33
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Rate;

class LoadRatesData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $rates =  ["2G", "3G", "4G"];

        foreach ($rates as $rate)
        {
            $rateFixture = new Rate();
            $rateFixture->setName($rate);
            $manager->persist($rateFixture);
            $this->addReference($rate, $rateFixture);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 2;
    }
}

