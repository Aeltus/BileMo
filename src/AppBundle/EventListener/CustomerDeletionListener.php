<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 16/07/17
 * Time: 21:37
 */
namespace AppBundle\EventListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use CustomerBundle\Entity\Customer;

class CustomerDeletionListener
{
    public function preRemove(LifecycleEventArgs $args)
    {

        $entity = $args->getObject();
        $em = $args->getEntityManager();

        if (!$entity instanceof Customer) {
            return;
        }

        $address = $entity->getBillingAddress();
        $entity->eraseBillingAddress();
        $em->remove($address);

        foreach ($entity->getDeliveryAddresses() as $deliveryAddress)
        {
            $entity->removeDeliveryAddress($deliveryAddress);
            $em->remove($deliveryAddress);
        }

        $em->flush();
    }
}
