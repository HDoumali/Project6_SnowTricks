<?php
// src/OC/PlatformBundle/DataFixtures/ORM/LoadCategory.php

//POUR FAIRE UNE FIXTURE DOCTRINE (ajouter un jeu de données dans la bdd ) : C:\wamp64\www\Symfony>php bin/console doctrine:fixtures:load
//IMPORTANT : pour ajouter un jeu de données en plus des données deja présentes, il faut ajouter l'option --append à la commande.

namespace ST\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ST\AppBundle\Entity\Trick;
use ST\AppBundle\Entity\Category;

class LoadTrick implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    $trick = new Trick(); 
    $trick->setName('Mute');
    $trick->setDescription('Saisie de la carre frontside de la planche entre les deux pieds avec la main avant');
    $manager->persist($trick);
    
    $trick = new Trick(); 
    $trick->setName('Sad');
    $trick->setDescription('Saisie de la carre backside de la planche, entre les deux pieds, avec la main avant');
    $manager->persist($trick);

    $trick = new Trick(); 
    $trick->setName('Indy');
    $trick->setDescription('Saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière');
    $manager->persist($trick);

    $trick = new Trick(); 
    $trick->setName('Stalefish');
    $trick->setDescription('Saisie de la carre backside de la planche entre les deux pieds avec la main arrière');
    $manager->persist($trick);

    $trick = new Trick(); 
    $trick->setName('Tail grab');
    $trick->setDescription('Saisie de la partie arrière de la planche, avec la main arrière');
    $manager->persist($trick);

    $trick = new Trick(); 
    $trick->setName('Seat belt');
    $trick->setDescription('Saisie du carre frontside à l\'arrière avec la main avant');
    $manager->persist($trick);

    $trick = new Trick(); 
    $trick->setName('180');
    $trick->setDescription('Désigne un demi-tour, soit 180 degrés d\'angle');
    $manager->persist($trick);

    $trick = new Trick(); 
    $trick->setName('360');
    $trick->setDescription('Désigne un trois six pour un tour complet');
    $manager->persist($trick);

    $trick = new Trick(); 
    $trick->setName('Method Air');
    $trick->setDescription('Désigne un style de freestyle caractérisée par en ensemble de figure');
    $manager->persist($trick);

    $trick = new Trick(); 
    $trick->setName('Mute');
    $trick->setDescription('Saisie de la carre frontside de la planche entre les deux pieds avec la main avant');
    $manager->persist($trick);
    
    $trick = new Trick(); 
    $trick->setName('Sad');
    $trick->setDescription('Saisie de la carre backside de la planche, entre les deux pieds, avec la main avant');
    $manager->persist($trick);

    $trick = new Trick(); 
    $trick->setName('Indy');
    $trick->setDescription('Saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière');
    $manager->persist($trick);

    $trick = new Trick(); 
    $trick->setName('Stalefish');
    $trick->setDescription('Saisie de la carre backside de la planche entre les deux pieds avec la main arrière');
    $manager->persist($trick);

    $trick = new Trick(); 
    $trick->setName('Tail grab');
    $trick->setDescription('Saisie de la partie arrière de la planche, avec la main arrière');
    $manager->persist($trick);

    $trick = new Trick(); 
    $trick->setName('Seat belt');
    $trick->setDescription('Saisie du carre frontside à l\'arrière avec la main avant');
    $manager->persist($trick);

    $trick = new Trick(); 
    $trick->setName('180');
    $trick->setDescription('Désigne un demi-tour, soit 180 degrés d\'angle');
    $manager->persist($trick);

    $trick = new Trick(); 
    $trick->setName('360');
    $trick->setDescription('Désigne un trois six pour un tour complet');
    $manager->persist($trick);

    $trick = new Trick(); 
    $trick->setName('Method Air');
    $trick->setDescription('Désigne un style de freestyle caractérisée par en ensemble de figure');
    $manager->persist($trick);

    $manager->flush();
  }
}