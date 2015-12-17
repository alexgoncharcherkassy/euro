<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Coach;
use AppBundle\Entity\Country;
use AppBundle\Entity\Game;
use AppBundle\Entity\Player;
use AppBundle\Entity\ResultGame;
use AppBundle\Entity\Team;
use AppBundle\Form\CoachType;
use AppBundle\Form\CountryType;
use AppBundle\Form\PlayerType;
use AppBundle\Form\TeamType;
use AppBundle\Model\SetResults;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Faker\Factory;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AdminController
 * @package AppBundle\Controller
 */
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
     * @Route("/admin/insert/team", name="team_insert_admin")
     * @Template("AppBundle:admin:insertTeam.html.twig")
     *
     */
    public function insertTeamAction(Request $request)
    {
        $team = new Team();
        $results = new SetResults();
        $form = $this->createForm(new TeamType(), $team);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $res = $results->setStartResult($team);
                $em->persist($res);
                $em->persist($team);
                $em->flush();

                $this->addFlash('notice', 'Country '. $team->getCountry(). ' added');

                return $this->redirectToRoute('team_insert_admin');
            }
        }
        return ['form' => $form->createView()];
    }

     /**
     * @Route("/admin/insert/country/{id}", name="country_insert_admin", requirements={"id" : "\d+"})
     * @Template("@App/admin/insertCountry.html.twig")
     */
    public function insertCountryAction(Request $request, $id)
    {
        $country = new Country();
        $em = $this->getDoctrine()->getManager();
        $team = $em->getRepository('AppBundle:Team')->find($id);

        $form = $this->createForm(new CountryType(), $country);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {

                $country->setTeam($team);
                $em->persist($country);
                $em->flush();

                $this->addFlash('notice', 'Description country '. $country->getFullTitle(). ' added');

                return $this->redirectToRoute('team_insert_admin');
            }
        }
        return ['form' => $form->createView()];
    }

    /**
     * @Route("/admin/insert/coach/{id}", name="coach_insert_admin", requirements={"id" : "\d+"})
     * @Template("@App/admin/insertCoach.html.twig")
     */
    public function insertCoachAction(Request $request, $id)
    {
        $coach = new Coach();
        $em = $this->getDoctrine()->getManager();
        $team = $em->getRepository('AppBundle:Team')->find($id);

        $form = $this->createForm(new CoachType(), $coach);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {

                $coach->setTeam($team);
                $em->persist($coach);
                $em->flush();

                $this->addFlash('notice', 'Coach '. $coach->getFirstName().' '.$coach->getLastName().
                    ' added to team '. $team->getCountry());

                return $this->redirectToRoute('team_insert_admin');
            }
        }
        return ['form' => $form->createView()];

    }

    /**
     * @Route("/admin/insert/player/{id}", name="player_insert_admin", requirements={"id" : "\d+"})
     * @Template("@App/admin/insertPlayer.html.twig")
     */
    public function insertPlayerAction(Request $request, $id)
    {
        $player = new Player();
        $em = $this->getDoctrine()->getManager();
        $team = $em->getRepository('AppBundle:Team')->find($id);

        $form = $this->createForm(new PlayerType(), $player);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {

                $player->setTeam($team);
                $em->persist($player);
                $em->flush();

                $this->addFlash('notice', 'Player '. $player->getFirstName().' '.$player->getLastName().
                    ' added to team '. $team->getCountry());

                return $this->redirectToRoute('team_insert_admin');
            }
        }
        return ['form' => $form->createView()];


    }

    /**
     * @Route("/admin/insert/game/", name="game_insert_admin")
     *
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
            $goals1 = rand(0, 5);
            $goals2 = rand(0, 5);
            $team1 = ($arr[rand(0, $count-1)]);
            $team2 = ($arr[rand(0, $count-1)]);
            $game->setGoals1($goals1);
            $game->setGoals2($goals2);
            $game->setTeam1($team1->getCountry());
            $game->setTeam2($team2->getCountry());
            $game->setTeam1Id($team1);
            $game->setTeam2Id($team2);
            $em->persist($game);
        }
        $em->flush();

        $this->addFlash(
            'notice',
            'Add games!'
        );

        return $this->forward('AppBundle:Admin:show');

    }

    /**
     * @Route("/admin/insert/result/{id}", name="result_insert_admin", requirements={"id" : "\d+"})
     */
    public function generateResultGameAction($id)
    {
        $teams = $this->getDoctrine()
            ->getRepository('AppBundle:Team')
            ->find($id);

        if (!$teams) {
            throw $this->createNotFoundException(
                'Not found');
        }

        $em = $this->getDoctrine()->getManager();

        $result = new ResultGame();
        $result->setTeam($teams);
        $result->setCountGame(rand(0, 20));
        $result->setWinGame(rand(0, 15));
        $result->setDrawGame(rand(0, 15));
        $result->setDefeatGame(rand(0, 15));
        $result->setPoints(rand(0, 30));
        $em->persist($result);
        $em->flush();

        $this->addFlash(
            'notice',
            'Add results!'
        );

        return $this->forward('AppBundle:Admin:show');
    }
}
