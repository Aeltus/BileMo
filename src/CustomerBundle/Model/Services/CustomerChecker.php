<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 30/07/17
 * Time: 21:43
 */
namespace CustomerBundle\Model\Services;

use ConsumerBundle\Entity\Consumer;
use CustomerBundle\Entity\Customer;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CustomerChecker
{
    public function Owner(Consumer $consumer, Customer $customer)
    {
        if ($consumer->getId() !== $customer->getConsumer()->getId())
        {
            throw new NotFoundHttpException('Cet utilisateur n\'existe pas.');
        }
    }
}
