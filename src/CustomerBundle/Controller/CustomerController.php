<?php

namespace CustomerBundle\Controller;

use AppBundle\Entity\Address;
use AppBundle\Entity\Country;
use ConsumerBundle\Entity\Consumer;
use FOS\RestBundle\Controller\FOSRestController;
use CustomerBundle\Entity\Customer;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Hateoas\Configuration\Route;
use Hateoas\Representation\Factory\PagerfantaFactory;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Nelmio\ApiDocBundle\Annotation as Doc;

class CustomerController extends FOSRestController
{
    /**
     * @Doc\ApiDoc(
     *     section="Customers",
     *     resource=true,
     *     description="Get all customers",
     *     statusCodes={
     *          200="Returned when ok"
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
     * @Rest\Get(
     *     path = "/customers",
     *     name = "customers_customers_show"
     * )
     * @Rest\QueryParam(
     *     name="mail",
     *     requirements="^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$",
     *     nullable=true,
     *     description="The mail to search for"
     * )
     * @Rest\QueryParam(
     *     name="order",
     *     requirements="asc|desc",
     *     default="asc",
     *     description="Sort order (asc or desc)"
     * )
     * @Rest\QueryParam(
     *     name="limit",
     *     requirements="\d+",
     *     default="10",
     *     description="Max number of products per page."
     * )
     * @Rest\QueryParam(
     *     name="page",
     *     requirements="\d+",
     *     default="1",
     *     description="The pagination offset"
     * )
     *
     * @Rest\QueryParam(
     *     name="isAvailable",
     *     requirements="TRUE|FALSE|true|false|0|1",
     *     default="TRUE",
     *     description="Availability of the customer (TRUE or FALSE)"
     * )
     *
     * @Rest\View(
     *     statusCode = 200
     * )
     */
    public function customersAction($mail, $order, $limit, $page, $isAvailable)
    {
        if (strtolower($isAvailable) == 'true' || $isAvailable == 1){
            $isAvailable = TRUE;
        } else {
            $isAvailable = FALSE;
        }

        $consumer = $this->getDoctrine()->getRepository('ConsumerBundle:Consumer')->findOneById($this->get('security.token_storage')->getToken()->getUser()->getId());

        $pager = $this->getDoctrine()->getRepository('CustomerBundle:Customer')->search(
            $mail,
            $order,
            $limit,
            $page,
            $isAvailable,
            $consumer
        );

        $pagerfantaFactory   = new PagerfantaFactory();
        $paginatedCollection = $pagerfantaFactory->createRepresentation(
            $pager,
            new Route('customers_customers_show', array(), true)
        );

        return $paginatedCollection;
    }

    /**
     * @Doc\ApiDoc(
     *     section="Customers",
     *     resource=true,
     *     description="Get a customer identified by {id}",
     *     statusCodes={
     *          200="Returned when ok",
     *          404="Returned when customer is not found"
     *     },
     *     requirements={
     *         {
     *             "name"="id",
     *             "dataType"="integer",
     *             "requirement"="\d+",
     *             "description"="The customer unique identifier."
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
     * @Rest\Get(
     *     path = "/customers/{id}",
     *     name = "customers_customers_show_one",
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\View(
     *     statusCode = 200
     * )
     */
    public function customerAction(Customer $customer)
    {
        $consumer = $this->getDoctrine()->getRepository('ConsumerBundle:Consumer')->findOneById($this->get('security.token_storage')->getToken()->getUser()->getId());

        $customerChecker = $this->container->get('customer_checker');
        $customerChecker->Owner($consumer, $customer);
        return $customer;
    }

    /**
     * @Doc\ApiDoc(
     *     section="Customers",
     *     resource=true,
     *     description="Add a customer. Accept a customer entity in JSON format, in body.",
     *     input={
     *      "class"="CustomerBundle\Entity\Customer",
     *     },
     *     statusCodes={
     *          201="Returned when ok",
     *          400="Returned when JSON is not valid"
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
     *     path = "/customers",
     *     name = "customers_customers_create"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("customer", converter="fos_rest.request_body")
     */
    public function createAction(Customer $customer, ConstraintViolationList $violations)
    {
        $consumer = $this->getDoctrine()->getRepository('ConsumerBundle:Consumer')->findOneById($this->get('security.token_storage')->getToken()->getUser()->getId());

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
        $customerRepo = $em->getRepository('CustomerBundle:Customer');


        if($customerRepo->findOneFor($customer, $consumer)){
            throw new BadRequestHttpException('Ce mail existe déjà, vous ne pouvez créer deux comptes comportant le même mail. Si vous avez déjà un compte, vous pouvez le récupérer.');
        }

        /*
         * Checking for Addresses validity
         */
        $addressChecker = $this->container->get('address_checker');

        foreach($customer->getDeliveryAddresses() as $deliveryAddress)
        {
            $addressChecker->check($deliveryAddress, $em);
            $deliveryAddress->setCustomerAddress($customer);

        }
        $addressChecker->check($customer->getBillingAddress(), $em);

        $customer->setConsumer($consumer);

        $em->persist($customer);
        $em->flush();

        return $customer;
    }

    /**
     * @Doc\ApiDoc(
     *     section="Customers",
     *     resource=true,
     *     description="Update a customer identified by {id}. Accept a customer entity in JSON format, in body.",
     *     statusCodes={
     *          200="Returned when ok",
     *          400="Returned when JSON is not valid",
     *          404="Returned when customer is not found"
     *     },
     *     input={
     *      "class"="CustomerBundle\Entity\Customer",
     *     },
     *     requirements={
     *         {
     *             "name"="id",
     *             "dataType"="integer",
     *             "requirement"="\d+",
     *             "description"="The customer unique identifier."
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
     *     path = "/customers/{id}",
     *     name = "customers_customers_update",
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\View(StatusCode = 200)
     * @ParamConverter("newCustomer", converter="fos_rest.request_body")
     */
    public function updateAction(Customer $customer, Customer $newCustomer, ConstraintViolationList $violations)
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
        $consumer = $this->getDoctrine()->getRepository('ConsumerBundle:Consumer')->findOneById($this->get('security.token_storage')->getToken()->getUser()->getId());

        $customerChecker = $this->container->get('customer_checker');
        $customerChecker->owner($consumer, $customer);

        $em = $this->getDoctrine()->getManager();
        $customerRepo = $em->getRepository('CustomerBundle:Customer');


        if($customerRepo->findOneFor($customer, $consumer)){
            if($customer->getMail() !== $newCustomer->getMail()){
                throw new BadRequestHttpException('Ce mail existe déjà, vous ne pouvez créer deux comptes comportant le même mail.');
            }
        }

        $customer->setPassword($newCustomer->getPassword())
                 ->setSalt($newCustomer->getSalt())
                 ->setIsChecked($newCustomer->IsChecked())
                 ->setName($newCustomer->getName())
                 ->setSurname($newCustomer->getSurname())
                 ->setPhone($newCustomer->getPhone())
                 ->setCellPhone($newCustomer->getCellPhone())
                 ->setMail($newCustomer->getMail())
                 ->setIsAvailable($newCustomer->IsAvailable())
        ;

        $em->flush();

        return $customer;
    }

    /**
     * @Doc\ApiDoc(
     *     section="Customers",
     *     resource=true,
     *     description="Delete a customer identified by {id}. (The customer is not completely deleted, his property isAvailable is set to False)",
     *     statusCodes={
     *          204="Returned when ok",
     *          404="Returned when customer is not found"
     *     },
     *     requirements={
     *         {
     *             "name"="id",
     *             "dataType"="integer",
     *             "requirement"="\d+",
     *             "description"="The customer unique identifier."
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
     * @Rest\View(StatusCode = 204)
     * @Rest\Delete(
     *     path = "/customers/{id}",
     *     name = "customers_customers_delete",
     *     requirements = {"id"="\d+"}
     * )
     */
    public function deleteAction(Customer $customer)
    {
        $consumer = $this->getDoctrine()->getRepository('ConsumerBundle:Consumer')->findOneById($this->get('security.token_storage')->getToken()->getUser()->getId());

        $customerChecker = $this->container->get('customer_checker');
        $customerChecker->owner($consumer, $customer);
        $em = $this->getDoctrine()->getManager();
        $customer->setIsAvailable(False);
        $em->flush();

        return;
    }
}
