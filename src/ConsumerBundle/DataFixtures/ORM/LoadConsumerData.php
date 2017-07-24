<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 14/07/17
 * Time: 10:26
 */

namespace ConsumerBundle\DataFixtures\ORM;

use AppBundle\Entity\Address;
use AppBundle\Entity\Brand;
use ConsumerBundle\Entity\Consumer;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadConsumerData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $consumers = [
            1 => [
                "name" => "Doe",
                "surname" => "John",
                "billingAddress" => [
                    "address1" => "1 rue de la place",
                    "address2" => NULL,
                    "address3" => NULL,
                    "city" => $this->getReference('Carcassonne'),
                    "isAvailable" => true,
                    "isDefault" => true
                ],
                "phone" => "0468000000",
                "cellPhone" => NULL,
                "mail" => "john.doe@monmail.com",
                "isAvailable" => true,
                "societyName" => "Doe Compagny",
                "paymentsDelay" => "30JFM",
                "brands" => NULL,
                "facebookId" => "10212796389282922",
                ],
            2 => [
                "name" => "Doe",
                "surname" => "Jane",
                "billingAddress" => [
                    "address1" => "1 rue de la mairie",
                    "address2" => NULL,
                    "address3" => NULL,
                    "city" => $this->getReference('Mirepoix'),
                    "isAvailable" => true,
                    "isDefault" => true
                ],
                "phone" => "0468000001",
                "cellPhone" => NULL,
                "mail" => "jane.doe@monmail.com",
                "isAvailable" => true,
                "societyName" => "Doe Compagny and sons",
                "paymentsDelay" => "30JN",
                "brands" => [
                    $this->getReference('Samsung'),
                    $this->getReference('Apple')
                ],
                "facebookId" => NULL,
            ]
        ];

        foreach ($consumers as $consumer)
        {
            $consumerFixtures = new Consumer();
            foreach ($consumer as $consumerDataName => $consumerData){
                if ($consumerDataName == "billingAddress"){
                    $billingAdress = new Address();
                    $billingAdress->setAddress1($consumerData['address1']);
                    $billingAdress->setAddress2($consumerData['address2']);
                    $billingAdress->setAddress3($consumerData['address3']);
                    $billingAdress->setCity($consumerData['city']);
                    $billingAdress->setIsAvailable($consumerData['isAvailable']);
                    $billingAdress->setIsDefault($consumerData['isDefault']);
                    $manager->persist($billingAdress);
                    $consumerFixtures->setBillingAddress($billingAdress);
                } elseif ($consumerDataName == "brands"){
                    if ($consumerData !== NULL){
                        foreach ($consumerData as $brand){
                            $consumerFixtures->addBrand($brand);
                        }
                    }
                } else {
                    $method = 'set'.ucfirst($consumerDataName);
                    $consumerFixtures->$method($consumerData);
                }
            }
            $this->addReference($consumerFixtures->getSocietyName(), $consumerFixtures);
            $manager->persist($consumerFixtures);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 9;
    }
}

