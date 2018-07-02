<?php

namespace ST\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ST\AppBundle\Entity\Category;

class LoadCategory implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
       $names = array(
        'Les grabs',
        'Les rotations',
        'Les flips',
        'Les rotations désaxées',
        'Les slides',
        'Old school'
       );
       
       foreach ($names as $name) {
          $category = new Category();
          $category->setName($name);

          $manager->persist($category);
       }

       $manager->flush();
    }
}