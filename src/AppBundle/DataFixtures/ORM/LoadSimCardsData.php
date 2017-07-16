<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 02/07/17
 * Time: 16:00
 */
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\SimCard;

class LoadSimCardsData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $simCards =  ["Sim", "Micro-sim", "Nano-sim"];

        foreach ($simCards as $simCard)
        {
            $simCardFixture = new SimCard();
            $simCardFixture->setName($simCard);
            $manager->persist($simCardFixture);
            $this->addReference($simCard, $simCardFixture);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 4;
    }
}
