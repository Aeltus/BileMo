<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 04/07/17
 * Time: 20:52
 */
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Product;
use AppBundle\Entity\ParticularProduct;
use Symfony\Component\Yaml\Yaml;

class LoadProductsData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        // Get the Yaml informations
        $products = Yaml::parse(file_get_contents(__DIR__.'/../Datas/PhonesDatas.yml'));

        foreach ($products as $productName=>$productDatas)
        {
            $product = new Product();
            $objectList = ['brand', 'os', 'rate', 'simCard'];
            foreach ($productDatas as $dataName=>$productData)
            {
                if (!is_numeric($dataName))
                {
                    if (in_array($dataName, $objectList))
                    {
                        $object = $this->getReference($productData);
                        $toSend = $object;
                    } else {
                        $toSend = $productData;
                    }
                    $method = 'set'.ucfirst($dataName);
                    $product->$method($toSend);
                } else {
                    $particularProductDatas = $productDatas[$dataName];
                    $particularProduct = new ParticularProduct();
                    $reflexionObject = new \ReflectionObject($product);
                    $productAttributes = $reflexionObject->getProperties();
                    foreach ($productAttributes as $attribute)
                    {
                        $method = 'set'.ucfirst($attribute->getName());
                        if ($attribute->getName() == "isTactile")
                        {
                            $method2 = $attribute->getName();
                        } else {
                            $method2 = 'get'.ucfirst($attribute->getName());
                        }
                        if (method_exists($particularProduct, $method) && method_exists($product, $method2)){
                            $particularProduct->$method($product->$method2());
                        }
                    }

                    foreach ($particularProductDatas as $particularProductDataName=>$particularProductData)
                    {
                        if ($particularProductDataName !== "pictures")
                        {
                            if ($particularProductDataName !== "detailedProducts") {
                                $method = 'set' . ucfirst($particularProductDataName);
                                $particularProduct->$method($particularProductData);
                            }
                        } else {
                            foreach ($particularProductData as $pictureData)
                            {
                                $picture = $this->getReference($pictureData);
                                $particularProduct->addPicture($picture);
                            }
                        }
                    }
                    $manager->persist($particularProduct);
                }

            }
            $manager->persist($product);
        }


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 6;
    }
}
