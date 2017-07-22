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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Hateoas\Configuration\Route;
use Hateoas\Representation\Factory\PagerfantaFactory;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class CustomerController extends FOSRestController
{
    /**
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
        $pager = $this->getDoctrine()->getRepository('CustomerBundle:Customer')->search(
            $mail,
            $order,
            $limit,
            $page,
            $isAvailable
        );

        $pagerfantaFactory   = new PagerfantaFactory();
        $paginatedCollection = $pagerfantaFactory->createRepresentation(
            $pager,
            new Route('customers_customers_show', array(), true)
        );

        return $paginatedCollection;
    }

    /**
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
        return $customer;
    }

    /**
     * @Rest\Post(
     *     path = "/customers",
     *     name = "customers_customers_create"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("customer", converter="fos_rest.request_body")
     */
    public function createAction(Customer $customer, ConstraintViolationList $violations)
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
        $consumerRepo = $em->getRepository('ConsumerBundle:Consumer');
        $customerRepo = $em->getRepository('CustomerBundle:Customer');

        if($customerRepo->findOneBy(['mail' => $customer->getMail()])){
            throw new BadRequestHttpException('Ce mail existe déjà, vous ne pouvez créer deux comptes comportant le même mail. Si vous avez déjà un compte, vous pouvez le récupérer.');
        }

        if (!$consumer = $consumerRepo->findOneBy(['id' => $customer->getConsumerKey()])){
            throw new BadRequestHttpException('Ce vendeur n\'existe pas.');
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

        $em = $this->getDoctrine()->getManager();
        $consumerRepo = $em->getRepository('ConsumerBundle:Consumer');

        if (!$consumer = $consumerRepo->findOneBy(['id' => $customer->getConsumerKey()])){
            throw new BadRequestHttpException('Ce vendeur n\'existe pas.');
        }

        $customer->setPassword($newCustomer->getPassword());
        $customer->setSalt($newCustomer->getSalt());
        $customer->setIsChecked($newCustomer->IsChecked());
        $customer->setName($newCustomer->getName());
        $customer->setSurname($newCustomer->getSurname());
        $customer->setPhone($newCustomer->getPhone());
        $customer->setCellPhone($newCustomer->getCellPhone());
        $customer->setMail($newCustomer->getMail());
        $customer->setIsAvailable($newCustomer->IsAvailable());

        $em->flush();

        return $customer;
    }

    /**
     * @Rest\View(StatusCode = 204)
     * @Rest\Delete(
     *     path = "/customers/{id}",
     *     name = "customers_customers_delete",
     *     requirements = {"id"="\d+"}
     * )
     */
    public function deleteAction(Customer $customer)
    {
        $em = $this->getDoctrine()->getManager();
        $customer->setIsAvailable(False);
        $em->flush();

        return;
    }
}
