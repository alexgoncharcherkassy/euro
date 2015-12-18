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
use AppBundle\Form\GameType;
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
     * @Route("/admin/insert/team/", name="team_insert_admin")
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
     * @Route("/admin/insert/country/", name="country_insert_admin")
     * @Template("@App/admin/insertCountry.html.twig")
     */
    public function insertCountryAction(Request $request)
    {
        $country = new Country();
        $em = $this->getDoctrine()->getManager();
     //   $team = $em->getRepository('AppBundle:Team')->find($id);

        $form = $this->createForm(new CountryType(), $country);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $team = $form->getData()->getTeam();
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
     * @Route("/admin/insert/coach/", name="coach_insert_admin")
     * @Template("@App/admin/insertCoach.html.twig")
     */
    public function insertCoachAction(Request $request)
    {
        $coach = new Coach();
        $em = $this->getDoctrine()->getManager();
    //    $team = $em->getRepository('AppBundle:Team')->find($id);

        $form = $this->createForm(new CoachType(), $coach);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $team = $form->getData()->getTeam();
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
     * @Route("/admin/insert/player/", name="player_insert_admin")
     * @Template("@App/admin/insertPlayer.html.twig")
     */
    public function insertPlayerAction(Request $request)
    {
        $player = new Player();
        $em = $this->getDoctrine()->getManager();
    //    $team = $em->getRepository('AppBundle:Team')->find($id);

        $form = $this->createForm(new PlayerType(), $player);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $team = $form->getData()->getTeam();
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
     * @Template("@App/admin/insertGame.html.twig")
     */
    public function insertGameAction(Request $request)
    {

        $game = new Game();
        $em = $this->getDoctrine()->getManager();
        //    $team = $em->getRepository('AppBundle:Team')->find($id);

        $form = $this->createForm(new GameType(), $game);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $team1 = $form->getData()->getTeam1Id();
                $team2 = $form->getData()->getTeam2Id();
                $game->setTeam1Id($team1);
                $game->setTeam2Id($team2);
                $game->setTeam1($team1->getCountry());
                $game->setTeam2($team2->getCountry());
                $em->persist($game);
                $em->flush();
                $f = $form->getData();

                if ($form->getData()->getGoals1() > $form->getData()->getGoals2()) {
                    $this->insertResultGameAction($team1, 'win');
                    $this->insertResultGameAction($team2, 'defeat');
                } elseif ($form->getData()->getGoals1() < $form->getData()->getGoals2()) {
                    $this->insertResultGameAction($team1, 'defeat');
                    $this->insertResultGameAction($team2, 'win');
                } else {
                    $this->insertResultGameAction($team1, 'draw');
                    $this->insertResultGameAction($team2, 'draw');
                }


                $this->addFlash('notice', 'Game '. $game->getTeam1().' vs '.$game->getTeam2().' added');

                return $this->redirectToRoute('team_insert_admin');
            }
        }
        return ['form' => $form->createView()];

    }

    /**
     *
     */
    public function insertResultGameAction(Team $team, $status = '')
    {
        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository('AppBundle:ResultGame')
            ->findOneBy(array('team' => $team->getId()));

        $countGame = $result->getCountGame();
        $winGame = $result->getWinGame();
        $drawGame = $result->getDrawGame();
        $defeatGame = $result->getDefeatGame();
        $points = $result->getPoints();

        switch ($status) {
            case 'win' :
                $result->setCountGame(++$countGame);
                $result->setWinGame(++$winGame);
                $result->setPoints(3 * $winGame + $drawGame);
                break;
            case 'defeat' :
                $result->setCountGame(++$countGame);
                $result->setDefeatGame(++$defeatGame);
                $result->setPoints(3 * $winGame + $drawGame);
                break;
            case 'draw' :
                $result->setCountGame(++$countGame);
                $result->setDrawGame(++$drawGame);
                $result->setPoints(3 * $winGame + $drawGame);
                break;
        }

        $em->flush();
        return;


    }
}
