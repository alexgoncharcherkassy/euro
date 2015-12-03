<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Faker\Factory;
use AppBundle\Entity\Player;
use Symfony\Component\HttpFoundation\Response;

class PlayerController extends Controller
{
    /**
     * @Route("/players/{player}", name = "player_show", requirements={"player" : "\d+"})
     * @Template("AppBundle:player:show.html.twig")
     */
    public function showAction($player)
    {
        $players = $this->getDoctrine()
            ->getRepository('AppBundle:Player')
            ->findAll();

        if (!$players) {
            throw $this->createNotFoundException(
                'Not found');
        }

        return ['players' => $players];
    }

    /**
     * @Route("/admin/insert/player", name="player_insert")
     */
    public function generatePlayerAction()
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
        return new Response('add player');
    }
}
