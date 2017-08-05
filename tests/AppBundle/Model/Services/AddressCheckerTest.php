<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 05/08/17
 * Time: 10:32
 */
namespace AppBundle\Model\Services;

use AppBundle\Entity\Address;
use AppBundle\Entity\City;
use AppBundle\Entity\Country;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AddressCheckerTest extends KernelTestCase
{
    private $container;

    public function setUp()
    {
        self::bootKernel();

        $this->container = self::$kernel->getContainer();
    }

    public function testAddressChecker()
    {
        $em = $this->container->get('doctrine')->getManager();

        $country = new Country();
        $country->setName('France');

        $city = new City();
        $city->setName('Carcassonne');
        $city->setZipCode(11000);
        $city->setCountry($country);

        $address = new Address();
        $address->setAddress1("30 rue de la Mairie");
        $address->setIsAvailable(true);
        $address->setIsDefault(true);
        $address->setCity($city);
        $address->setCustomerAddress(NULL);

        $addressChecker = $this->container->get('address_checker');

        $this->assertEquals(true, $addressChecker->check($address, $em));
    }
}
