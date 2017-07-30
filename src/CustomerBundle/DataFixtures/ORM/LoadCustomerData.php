<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 14/07/17
 * Time: 11:49
 */
namespace CustomerBundle\DataFixtures\ORM;

use AppBundle\Entity\Address;
use CustomerBundle\Entity\Customer;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCustomerData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $customers = [
            1 => [
                "name" => "Dupont",
                "surname" => "Pierre",
                "billingAddress" => [
                    "address1" => "1 rue de la plage",
                    "address2" => NULL,
                    "address3" => NULL,
                    "city" => $this->getReference('Carcassonne'),
                    "isAvailable" => true,
                    "isDefault" => true
                ],
                "phone" => "0468000003",
                "cellPhone" => NULL,
                "mail" => "pierre.dupont@monmail.com",
                "deliveryAddress" => [
                    "address1" => "1 rue de la plage",
                    "address2" => NULL,
                    "address3" => NULL,
                    "city" => $this->getReference('Carcassonne'),
                    "isAvailable" => true,
                    "isDefault" => true
                ],
                "isAvailable" => true,
                "password" => "my_encoded_password",
                "salt" => "my_encoded_salt",
                "isChecked" => true,
                "consumer" => "Doe Compagny"
            ],
            2 => [
                "name" => "Dupond",
                "surname" => "Sophie",
                "billingAddress" => [
                    "address1" => "1 rue de l'église",
                    "address2" => NULL,
                    "address3" => NULL,
                    "city" => $this->getReference('Mirepoix'),
                    "isAvailable" => true,
                    "isDefault" => true
                ],
                "phone" => "0468000004",
                "cellPhone" => NULL,
                "mail" => "sophie.dupond@monmail.com",
                "deliveryAddress" => [
                    "address1" => "1 rue de l'église",
                    "address2" => NULL,
                    "address3" => NULL,
                    "city" => $this->getReference('Mirepoix'),
                    "isAvailable" => true,
                    "isDefault" => true
                ],
                "isAvailable" => true,
                "password" => "my_encoded_password",
                "salt" => "my_encoded_salt",
                "isChecked" => true,
                "consumer" => "Doe Compagny and sons"
            ],
            3 => [
                "name" => "Dufour",
                "surname" => "Antoine",
                "billingAddress" => [
                    "address1" => "1 rue de la mairie",
                    "address2" => NULL,
                    "address3" => NULL,
                    "city" => $this->getReference('Mirepoix'),
                    "isAvailable" => true,
                    "isDefault" => true
                ],
                "phone" => "0468000006",
                "cellPhone" => NULL,
                "mail" => "antoine.dufour@monmail.com",
                "deliveryAddress" => [
                    "address1" => "1 rue de la plage",
                    "address2" => NULL,
                    "address3" => NULL,
                    "city" => $this->getReference('Mirepoix'),
                    "isAvailable" => true,
                    "isDefault" => true
                ],
                "isAvailable" => false,
                "password" => "my_encoded_password",
                "salt" => "my_encoded_salt",
                "isChecked" => true,
                "consumer" => "Doe Compagny"
            ]
        ];

        foreach ($customers as $customer)
        {
            $customerFixtures = new Customer();
            foreach ($customer as $customerDataName => $customerData){
                if ($customerDataName == "billingAddress"){
                    $billingAdress = new Address();
                    $billingAdress->setAddress1($customerData['address1']);
                    $billingAdress->setAddress2($customerData['address2']);
                    $billingAdress->setAddress3($customerData['address3']);
                    $billingAdress->setCity($customerData['city']);
                    $billingAdress->setIsAvailable($customerData['isAvailable']);
                    $billingAdress->setIsDefault($customerData['isDefault']);
                    $customerFixtures->setBillingAddress($billingAdress);
                } elseif ($customerDataName == "consumer"){
                    if ($customerData !== NULL){
                        $customerFixtures->setConsumer($this->getReference($customerData));
                    }
                } elseif ($customerDataName == "deliveryAddress"){
                    $deliveryAdress = new Address();
                    $deliveryAdress->setAddress1($customerData['address1']);
                    $deliveryAdress->setAddress2($customerData['address2']);
                    $deliveryAdress->setAddress3($customerData['address3']);
                    $deliveryAdress->setCity($customerData['city']);
                    $deliveryAdress->setIsAvailable($customerData['isAvailable']);
                    $deliveryAdress->setIsDefault($customerData['isDefault']);
                    $deliveryAdress->setCustomerAddress($customerFixtures);
                    $customerFixtures->addDeliveryAddress($deliveryAdress);
                }else {
                    $method = 'set'.ucfirst($customerDataName);
                    $customerFixtures->$method($customerData);
                }
            }
            $manager->persist($deliveryAdress);
            $manager->persist($billingAdress);
            $manager->persist($customerFixtures);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 10;
    }
}


