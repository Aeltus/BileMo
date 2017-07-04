<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 02/07/17
 * Time: 18:58
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Picture;

class LoadPicturesData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        // clear the destination dir
        $dir = opendir(__DIR__."/../../../../web/bundles/AppBundle/pictures");
        while($file = readdir($dir)) {
            if($file!=in_array($file, array(".",".."))){
                unlink(__DIR__."/../../../../web/bundles/AppBundle/pictures/".$file);
            }
        }
        closedir($dir);

        // Copy new files in destination dir and create entries in database
        $defaults = [1, 4, 5, 8, 11, 14, 17, 20, 22];

        for ($i=1; $i < 25; $i++)
        {
            if (copy(__DIR__."/../Pictures/".$i.".jpg", __DIR__."/../../../../web/bundles/AppBundle/pictures/".$i.".jpg")) {
                $picture = new Picture();
                $picture->setUrl("/bundles/AppBundle/pictures/".$i.".jpg");
                $picture->setAlt("Prévisualisation du mobile");
                if (in_array($i, $defaults))
                {
                    $picture->setIsDefault(TRUE);
                }
                $manager->persist($picture);
                $this->addReference($i.'.jpg', $picture);
            }
        }

        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 5;
    }
}
