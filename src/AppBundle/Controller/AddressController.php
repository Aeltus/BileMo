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
use Nelmio\ApiDocBundle\Annotation as Doc;

class AddressController extends FOSRestController
{
    /**
     * @Doc\ApiDoc(
     *     section="Address",
     *     resource=true,
     *     description="Delete an address identified by {id}. (This address is set to not available, not completely deleted)",
     *     statusCodes={
     *          204="Returned when ok"
     *     },
     *     requirements={
     *         {
     *             "name"="address",
     *             "dataType"="integer",
     *             "requirement"="\d+",
     *             "description"="The address unique identifier."
     *         }
     *     },
     *     headers={
     *         {
     *             "name"="Authorization",
     *             "description"="Authorization key (obtained by OAuth2 authentication)",
     *             "required"="true"
     *         },
     *         {
     *             "name"="Accept",
     *             "description"="application/json;version=1.0",
     *             "required"="false"
     *         }
     *     }
     * )
     *
     * @Rest\View(StatusCode = 202)
     * @Rest\Delete(
     *     path = "/address/{address}",
     *     name = "app_address_delete",
     *     requirements = {"address"="\d+"}
     * )
     */
    public function deleteAction(Address $address)
    {
        $address->setIsAvailable(false);
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $address;
    }

    /**
     * @Doc\ApiDoc(
     *     section="Address",
     *     resource=true,
     *     description="Add an address to a Customer identified by {id}. Accept an address entity in JSON format, in body.",
     *     statusCodes={
     *          201="Returned when ok",
     *          400="Returned when the JSON is not correct",
     *          404="Returned when the Customer is not found"
     *     },
     *     input={
     *      "class"="AppBundle\Entity\Address",
     *     },
     *     requirements={
     *         {
     *             "name"="customer",
     *             "dataType"="integer",
     *             "requirement"="\d+",
     *             "description"="The Customer unique identifier."
     *         }
     *     },
     *     headers={
     *         {
     *             "name"="Authorization",
     *             "description"="Authorization key (obtained by OAuth2 authentication)",
     *             "required"="true"
     *         },
     *         {
     *             "name"="Accept",
     *             "description"="application/json;version=1.0",
     *             "required"="false"
     *         }
     *     }
     * )
     *
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
            $message = 'Le JSON envoyé est incorrect, vous devez envoyer un format JSON valide : ';
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

        $consumer = $this->getDoctrine()->getRepository('ConsumerBundle:Consumer')->findOneById($this->get('security.token_storage')->getToken()->getUser()->getId());
        $this->container->get('customer_checker')->owner($consumer, $customer);

        $address->setCustomerAddress($customer);
        $em->persist($address);
        $em->flush();

        return $customer;
    }

    /**
     * @Doc\ApiDoc(
     *     section="Address",
     *     resource=true,
     *     description="Update an address identified by {id}. Accept an address entity in JSON format, in body.",
     *     statusCodes={
     *          200="Returned when ok",
     *          400="Returned when JSON is not valid",
     *          404="Returned when the address is not found"
     *     },
     *     input={
     *      "class"="AppBundle\Entity\Address",
     *     },
     *     requirements={
     *         {
     *             "name"="id",
     *             "dataType"="integer",
     *             "requirement"="\d+",
     *             "description"="The address unique identifier."
     *         }
     *     },
     *     headers={
     *         {
     *             "name"="Authorization",
     *             "description"="Authorization key (obtained by OAuth2 authentication)",
     *             "required"="true"
     *         },
     *         {
     *             "name"="Accept",
     *             "description"="application/json;version=1.0",
     *             "required"="false"
     *         }
     *     }
     * )
     *
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
            $message = 'Le JSON envoyé est incorrect, vous devez envoyer un format JSON valide : ';
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

