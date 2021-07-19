<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Ouvrage;
use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        // $product = new Product();
        // $manager->persist($product);
        $adminRole = new Role();
        $adminRole->setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);

        $adminUser = new User();
        $adminUser->setEmail('thibaudlevy@titi.com')
            ->setPassword('password')
            ->setHash($this->encoder->encodePassword($adminUser, 'password'))
            ->addUserRole($adminRole);

        $manager->persist($adminUser);



        $authors = Array();
        for($i = 0; $i < 10; $i++) {
            $authors[$i] = new Author();
            $authors[$i]->setName($faker->name);
            $authors[$i]->setLastname($faker->lastName);
            $manager->persist($authors[$i]);
        }

        $ouvrage = [];

        for($i = 0; $i < 12; $i++) {
            $ouvrage[$i] = new Ouvrage();
            $ouvrage[$i]->setTitre($faker->company);
            $ouvrage[$i]->setISBN($faker->numberBetween(1, 1000));
            $ouvrage[$i]->setPrix($faker->numberBetween(10, 20));
            $ouvrage[$i]->setTheme("Horror");
            $ouvrage[$i]->setImage("https://via.placeholder.com/150");
            $ouvrage[$i]->setAuthor($authors[$i % 3]);

            $manager->persist($ouvrage[$i]);
        }

        $manager->flush();
    }
}
