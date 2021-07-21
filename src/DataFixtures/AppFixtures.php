<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Category;
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
        $adminRole = new Role();
        $adminRole->setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);

        $adminUser = new User();
        $adminUser->setEmail('thibaudlevy@titi.com')
            ->setname("Thibaud")
            ->setHash($this->encoder->encodePassword($adminUser, 'password'))
            ->addUserRole($adminRole);

        $manager->persist($adminUser);




        $fakerUser = new User();
        $fakerUser->setEmail('user@user.com')
            ->setname("User")
            ->setHash($this->encoder->encodePassword($fakerUser, 'password'));

        $manager->persist($fakerUser);

        $authors = Array();
        for($i = 0; $i < 10; $i++) {
            $authors[$i] = new Author();
            $authors[$i]->setName($faker->name);
            $authors[$i]->setLastname($faker->lastName);
            $manager->persist($authors[$i]);
        }

        $ouvrage = [];

        for($i = 0; $i < 12; $i++) {
            $category=new Category();
            $category->setName($faker->word);
            $manager->persist($category);
            $ouvrage[$i] = new Ouvrage();
            $ouvrage[$i]->setTitre($faker->company);
            $ouvrage[$i]->setISBN($faker->isbn10);
            $ouvrage[$i]->setPrix($faker->numberBetween(10, 20));
            $ouvrage[$i]->setTheme("Horror");
            $ouvrage[$i]->setResume($faker->sentence(50, true));
            $ouvrage[$i]->setImage("/assets/image/cover.png");
            $ouvrage[$i]->setAuthor($authors[$i % 3]);
            $ouvrage[$i]->addCategory($category);

            $manager->persist($ouvrage[$i]);
        }


        $manager->flush();
    }
}
