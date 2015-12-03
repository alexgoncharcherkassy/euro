<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Coach;
use AppBundle\Entity\Country;
use AppBundle\Entity\Game;
use AppBundle\Entity\Player;
use AppBundle\Entity\Team;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Faker\Factory;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="team_show_admin")
     * @Template("AppBundle:admin:show.html.twig")
     *
     */
    public function showAction()
    {
        $teams = $this->getDoctrine()
            ->getRepository('AppBundle:Team')
            ->findAll();

        if (!$teams) {
            throw $this->createNotFoundException(
                'Not found');
        }

        return ['teams' => $teams];
    }

    /**
     * @Route("/admin/insert/", name="team_insert_admin")
     */
    public function generateTeamAction()
    {
        $faker = Factory::create();

        $arr = 'ABCDEIFG';

        $em = $this->getDoctrine()->getManager();

        for ($i = 0; $i < 10; $i++) {
            $team = new Team();
            $team->setGroups(substr($arr, rand(0, strlen($arr) - 1), 1));
            $team->setCountry($faker->country);
            $em->persist($team);
        }
        $em->flush();

        return $this->forward('AppBundle:Admin:show');

    }

    /**
     * @Route("/admin/insert/country/{id}", name="country_insert_admin", requirements={"id" : "\d+"})
     *
     */
    public function generateCountryAction($id)
    {
        $teams = $this->getDoctrine()
            ->getRepository('AppBundle:Team')
            ->find($id);

        if (!$teams) {
            throw $this->createNotFoundException(
                'Not found');
        }
        $faker = Factory::create();

        $em = $this->getDoctrine()->getManager();

        $country = new Country();
        $country->setTeam($teams);
        $country->setFullTitle($faker->country);
        $country->setDescription($faker->text);
        $em->persist($country);
        $em->flush();

        $this->addFlash(
            'notice',
            'Add country!'
        );

        return $this->forward('AppBundle:Admin:show');

    }

    /**
     * @Route("/admin/insert/coach/{id}", name="coach_insert_admin", requirements={"id" : "\d+"})
     *
     */
    public function generateCoachAction($id)
    {
        $teams = $this->getDoctrine()
            ->getRepository('AppBundle:Team')
            ->find($id);

        if (!$teams) {
            throw $this->createNotFoundException(
                'Not found');
        }
        $faker = Factory::create();

        $em = $this->getDoctrine()->getManager();

        $coach = new Coach();
        $coach->setTeam($teams);
        $coach->setFirstName($faker->firstNameMale);
        $coach->setLastName($faker->lastName);
        $coach->setBirthDay($faker->dateTime);
        $coach->setBiography($faker->text);
        $em->persist($coach);
        $em->flush();

        $this->addFlash(
            'notice',
            'Add coach!'
        );

        return $this->forward('AppBundle:Admin:show');

    }

    /**
     * @Route("/admin/insert/player/{id}", name="player_insert_admin", requirements={"id" : "\d+"})
     */
    public function generatePlayerAction($id)
    {
        $teams = $this->getDoctrine()
            ->getRepository('AppBundle:Team')
            ->find($id);

        if (!$teams) {
            throw $this->createNotFoundException(
                'Not found');
        }
        $faker = Factory::create();

        $em = $this->getDoctrine()->getManager();
        for ($i = 0; $i < 10; $i++) {
            $player = new Player();
            $player->setTeam($teams);
            $player->setFirstName($faker->firstNameMale);
            $player->setLastName($faker->lastName);
            $player->setBirthDay($faker->dateTime);
            $player->setBiography($faker->text);
            $em->persist($player);
        }
        $em->flush();

        $this->addFlash(
            'notice',
            'Add players!'
        );

        return $this->forward('AppBundle:Admin:show');

    }

    /**
     * @Route("/admin/insert/game/", name="game_insert_admin")
     */
    public function generateGameAction()
    {
        $teams = $this->getDoctrine()
            ->getRepository('AppBundle:Team')
            ->findAll();

        if (!$teams) {
            throw $this->createNotFoundException(
                'Not found');
        }
        $count = 0;
        $arr = array();
        foreach ($teams as $team) {
            $arr[$count] = $team;
            $count++;
        }

        $faker = Factory::create();

        $em = $this->getDoctrine()->getManager();
        for ($i = 0; $i < 20; $i++) {
            $game = new Game();
            $game->setDateGame($faker->dateTime);
            $game->setGoals1(rand(0, 5));
            $game->setGoals2(rand(0, 5));
            $team1 = ($arr[rand(0, $count-1)]);
            $team2 = ($arr[rand(0, $count-1)]);
            $game->setTeam1($team1->getId());
            $game->setTeam2($team2->getId());
            $em->persist($game);
        }
        $em->flush();

        $this->addFlash(
            'notice',
            'Add games!'
        );

        return $this->forward('AppBundle:Admin:show');

    }
}
