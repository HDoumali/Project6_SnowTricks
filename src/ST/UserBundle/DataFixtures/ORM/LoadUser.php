<?php
// src/OC/PlatformBundle/DataFixtures/ORM/LoadCategory.php

//POUR FAIRE UNE FIXTURE DOCTRINE (ajouter un jeu de données dans la bdd ) : C:\wamp64\www\Symfony>php bin/console doctrine:fixtures:load
//IMPORTANT : pour ajouter un jeu de données en plus des données deja présentes, il faut ajouter l'option --append à la commande.

namespace ST\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ST\UserBundle\Entity\User;

class LoadUser implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    $user = new User();
    $user->setUsername('Paul');
    $user->setFirstname('Paul');
    $user->setLastname('Dupont');
    $user->setEmail('paul@paul.fr');
    $user->setPassword('paul');
    $user->setSalt('');
    $user->setRoles(array('ROLE_USER'));
    $manager->persist($user);

    $user = new User();
    $user->setUsername('Alexandre');
    $user->setFirstname('Alexandre');
    $user->setLastname('Dupont');
    $user->setEmail('alexandre@alexandre.fr');
    $user->setPassword('alexandre');
    $user->setSalt('');
    $user->setRoles(array('ROLE_USER'));
    $manager->persist($user);
    
    $user = new User();
    $user->setUsername('Nicolas');
    $user->setFirstname('Nicolas');
    $user->setLastname('Dupont');
    $user->setEmail('nicolas@nicolas.fr');
    $user->setPassword('nicolas');
    $user->setSalt('');
    $user->setRoles(array('ROLE_USER'));
    $manager->persist($user);

    $manager->flush();
  }
}