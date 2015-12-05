<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 02.12.15
 * Time: 19:49
 */

namespace AppBundle\Model;

use AppBundle\Entity\Coach;
use AppBundle\Entity\Country;
use AppBundle\Entity\Player;
use AppBundle\Entity\Team;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class Faker extends Controller
{

    public function generateTeam()
    {
        $faker = Factory::create();
        $team = new Team();
        $arr = 'ABCDEIFG';

        $em = $this->getDoctrine()->getManager();

        for ($i = 0; $i < 10; $i++) {
            $team->setGroups(substr ($arr, rand(0, strlen($arr)-1) , 1));
            $team->setCountry($faker->country);
            $em->persist($team);
        }
        $em->flush();

        $this->redirectToRoute('homepage');
    }

    public function generateCountry()
    {
        $faker = Factory::create();
        $country = new Country();

        $em = $this->getDoctrine()->getManager();

        for ($i = 0; $i < 10; $i++) {
            $country->setFullTitle($faker->country);
            $country->setDescription($faker->text);
            $em->persist($country);
        }
        $em->flush();

        $this->redirectToRoute('homepage');
    }

    public function generatePlayer()
    {
        $faker = Factory::create();
        $player = new Player();

        $em = $this->getDoctrine()->getManager();

        for ($i = 0; $i < 10; $i++) {
            $player->setFirstName($faker->firstNameMale);
            $player->setLastName($faker->lastName);
            $player->setBirthDay($faker->dateTime);
            $player->setBiography($faker->text);
            $em->persist($player);
        }
        $em->flush();

        $this->redirectToRoute('homepage');
    }

    public function generateCoach()
    {
        $faker = Factory::create();
        $coach = new Coach();

        $em = $this->getDoctrine()->getManager();

        for ($i = 0; $i < 10; $i++) {
            $coach->setFirstName($faker->firstNameMale);
            $coach->setLastName($faker->lastName);
            $coach->setBirthDay($faker->dateTime);
            $coach->setBiography($faker->text);
            $em->persist($coach);
        }
        $em->flush();

        $this->redirectToRoute('homepage');
    }



}