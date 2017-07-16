<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15/07/17
 * Time: 18:03
 */
namespace AppBundle\Controller;

use AppBundle\Entity\Address;
use CustomerBundle\Entity\Customer;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Hateoas\Configuration\Route;
use Symfony\Component\Validator\ConstraintViolationList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class AddressController extends FOSRestController
{
    /**
     * @Rest\View(StatusCode = 204)
     * @Rest\Delete(
     *     path = "/address/{address}/{customer}",
     *     name = "app_address_delete",
     *     requirements = {"address"="\d+", "customer"="\d+"}
     * )
     */
    public function deleteAction(Address $address, Customer $customer)
    {
        $customer->removeDeliveryAddress($address);
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return;
    }

    /**
     * @Rest\Post(
     *     path = "/address/{customer}",
     *     name = "app_address_create",
     *     requirements = {"customer"="\d+"}
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("address", converter="fos_rest.request_body")
     */
    public function createAction(Address $address,  Customer $customer, ConstraintViolationList $violations)
    {
        /*
         * Checking for Violations
         */
        if (count($violations)) {
            $message = 'The JSON sent contains invalid data. Here are the errors you need to correct: ';
            foreach ($violations as $violation) {
                $message .= sprintf("Field %s: %s ", $violation->getPropertyPath(), $violation->getMessage());
            }

            throw new BadRequestHttpException($violations);
        }

        $em = $this->getDoctrine()->getManager();
        /*
         * Checking for Addresses validity
         */
        $addressChecker = $this->container->get('address_checker');
        $addressChecker->check($address, $em);

        $address->setCustomerAddress($customer);
        $em->persist($address);
        $em->flush();

        return $customer;
    }

    /**
     * @Rest\Put(
     *     path = "/address/{id}",
     *     name = "app_address_update",
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\View(StatusCode = 200)
     * @ParamConverter("newAddress", converter="fos_rest.request_body")
     */
    public function updateAction(Address $address, Address $newAddress, ConstraintViolationList $violations)
    {
        /*
         * Checking for Violations
         */
        if (count($violations)) {
            $message = 'The JSON sent contains invalid data. Here are the errors you need to correct: ';
            foreach ($violations as $violation) {
                $message .= sprintf("Field %s: %s ", $violation->getPropertyPath(), $violation->getMessage());
            }

            throw new BadRequestHttpException($violations);
        }

        $em = $this->getDoctrine()->getManager();
        $addressChecker = $this->container->get('address_checker');

        $address->setAddress1($newAddress->getAddress1());
        $address->setAddress2($newAddress->getAddress2());
        $address->setAddress3($newAddress->getAddress3());
        $address->setIsAvailable($newAddress->isAvailable());
        $address->setIsDefault($newAddress->isDefault());
        $address->setCity($newAddress->getCity());
        $address->setCustomerAddress($newAddress->getCustomerAddress());

        $addressChecker->check($address, $em);

        $em->flush();

        return $address;
    }
}

