<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15/07/17
 * Time: 17:20
 */
namespace AppBundle\Services;

class AddressChecker
{
    public function Check($address, $em)
    {
        $cityRepo = $em->getRepository('AppBundle:City');
        $countryRepo = $em->getRepository('AppBundle:Country');

        if ($country = $countryRepo->findOneBy(['name' => $address->getCity()->getCountry()->getName()])){
            $address->getCity()->setCountry($country);
        } else {
            $country = $address->getCity()->getCountry();
            $em->persist($country);
        }

        if ($city = $cityRepo->findOneBy(['name' => $address->getCity()->getName()])){
            $address->setCity($city);
        } else {
            $city = $address->getCity();
            $em->persist($city);
        }
        $em->flush();
    }
}
