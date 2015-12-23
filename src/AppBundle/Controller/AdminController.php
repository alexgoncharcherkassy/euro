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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AdminController
 * @package AppBundle\Controller
 */
class AdminController extends Controller
{
    /**
     * @Route("/admin/", name="show_admin")
     * @Template("AppBundle:admin:show.html.twig")
     *
     */
    public function showAction()
    {
        return [];
    }

    /**
     * @Route("/admin/insert/team/", name="team_insert_admin")
     * @Template("@App/admin/insertForm.html.twig")
     *
     */
    public function insertTeamAction(Request $request)
    {
        $team = new Team();
        $form = $this->createForm(new TeamType(), $team);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $res = $this->setStartResult($team);
                $em->persist($res);
                $em->persist($team);
                $em->flush();

                $this->addFlash('notice', 'Country ' . $team->getCountry() . ' added');

                return $this->redirectToRoute('team_insert_admin');
            }
        }
        return ['form' => $form->createView()];
    }

    /**
     * @Route("/admin/insert/country/", name="country_insert_admin")
     * @Template("@App/admin/insertForm.html.twig")
     */
    public function insertCountryAction(Request $request)
    {
        $country = new Country();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new CountryType(), $country);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->persist($country);
                $em->flush();

                $this->addFlash('notice', 'Description country ' . $country->getFullTitle() . ' added');

                return $this->redirectToRoute('show_admin');
            }
        }

        return ['form' => $form->createView()];
    }

    /**
     * @Route("/admin/insert/coach/", name="coach_insert_admin")
     * @Template("@App/admin/insertForm.html.twig")
     */
    public function insertCoachAction(Request $request)
    {
        $coach = new Coach();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new CoachType(), $coach);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                /**
                 * @var Team $team
                 */
                $team = $form->getData()->getTeam();
                $em->persist($coach);
                $em->flush();

                $this->addFlash('notice', 'Coach ' . $coach->getFirstName() . ' ' . $coach->getLastName() .
                    ' added to team ' . $team->getCountry());

                return $this->redirectToRoute('show_admin');
            }
        }
        return ['form' => $form->createView()];

    }

    /**
     * @Route("/admin/insert/player/", name="player_insert_admin")
     * @Template("@App/admin/insertForm.html.twig")
     */
    public function insertPlayerAction(Request $request)
    {
        $player = new Player();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new PlayerType(), $player);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                /**
                 * @var Team $team
                 */
                $team = $form->getData()->getTeam();
                $em->persist($player);
                $em->flush();

                $this->addFlash('notice', 'Player ' . $player->getFirstName() . ' ' . $player->getLastName() .
                    ' added to team ' . $team->getCountry());

                return $this->redirectToRoute('player_insert_admin');
            }
        }
        return ['form' => $form->createView()];


    }

    /**
     * @Route("/admin/insert/game/", name="game_insert_admin")
     * @Template("@App/admin/insertForm.html.twig")
     */
    public function insertGameAction(Request $request)
    {

        $game = new Game();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new GameType(), $game);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                /**
                 * @var Team $team1
                 * @var Team $team2
                 */
                $team1 = $form->getData()->getTeam1Id();
                $team2 = $form->getData()->getTeam2Id();
                $game->setTeam1($team1->getCountry());
                $game->setTeam2($team2->getCountry());
                $em->persist($game);
                $em->flush();

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


                $this->addFlash('notice', 'Game ' . $game->getTeam1() . ' vs ' . $game->getTeam2() . ' added');

                return $this->redirectToRoute('homepage');
            }
        }
        return ['form' => $form->createView()];

    }

    /**
     * @param Team $team
     * @param string $status
     */
    private function insertResultGameAction(Team $team, $status = '')
    {
        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository('AppBundle:ResultGame')
            ->findOneBy(array('team' => $team->getId()));

        $countGame = $result->getCountGame();
        $winGame = $result->getWinGame();
        $drawGame = $result->getDrawGame();
        $defeatGame = $result->getDefeatGame();

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

    /**
     * @param Team $team
     * @return ResultGame
     */
    private function setStartResult(Team $team)
    {
        $results = new ResultGame();

        $results->setCountGame(0);
        $results->setWinGame(0);
        $results->setDrawGame(0);
        $results->setDefeatGame(0);
        $results->setPoints(0);
        $results->setTeam($team);

        return $results;
    }

    /**
     * @Route("/admin/delete/team/{id}", name="team_delete_admin")
     * @Template("@App/admin/removeUpdate.html.twig")
     */
    public function deleteTeamAction($id = null)
    {
        $em = $this->getDoctrine()->getManager();
        if ($id !== null) {
            $team = $em->getRepository('AppBundle:Team')
                ->find($id);

            $em->remove($team);
            $em->flush();

            $this->addFlash('notice', 'Team deleted');

            return $this->redirectToRoute('show_admin');
        }
        $team = $em->getRepository('AppBundle:Team')
            ->findAll();

        return ['teams' => $team];
    }

    /**
     * @Route("/admin/delete/team/elements/{id}", name="elements_delete_admin")
     * @Template("@App/admin/removeUpdateElement.html.twig")
     */
    public function deleteTeamElemwntsAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $team = $em->getRepository('AppBundle:Team')
            ->showTeamId($id);

        return ['teams' => $team];
    }

    /**
     * @Route("/admin/delete/country/{id}", name="country_delete_admin")
     */
    public function deleteCountryAction($id = null)
    {
        $em = $this->getDoctrine()->getManager();
        $country = $em->getRepository('AppBundle:Country')
            ->find($id);

        $em->remove($country);
        $em->flush();

        $this->addFlash('notice', 'Country deleted');

        return $this->redirectToRoute('show_admin');
    }

    /**
     * @Route("/admin/delete/coach/{id}", name="coach_delete_admin")
     */
    public function deleteCoachAction($id = null)
    {
        $em = $this->getDoctrine()->getManager();
        $coach = $em->getRepository('AppBundle:Coach')
            ->find($id);

        $em->remove($coach);
        $em->flush();

        $this->addFlash('notice', 'Coach deleted');

        return $this->redirectToRoute('show_admin');
    }

    /**
     * @Route("/admin/delete/player/{id}", name="player_delete_admin")
     */
    public function deletePlayerAction($id = null)
    {
        $em = $this->getDoctrine()->getManager();
        $player = $em->getRepository('AppBundle:Player')
            ->find($id);

        $em->remove($player);
        $em->flush();

        $this->addFlash('notice', 'Player deleted');

        return $this->redirectToRoute('show_admin');
    }

    /**
     * @Route("/admin/update/team/{id}", name="team_update_admin")
     * @Template("@App/admin/updateForm.html.twig")
     */
    public function updateTeamAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $team = $em->getRepository('AppBundle:Team')
            ->find($id);

        $form = $this->createForm(new TeamType(), $team);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {

                $em->flush();

                $this->addFlash('notice', 'Team ' . $team->getCountry() .
                    ' updated');

                return $this->redirectToRoute('team_delete_admin');
            }
        }
        return ['form' => $form->createView()];


    }

    /**
     * @Route("/admin/update/country/{id}", name="country_update_admin")
     * @Template("@App/admin/updateForm.html.twig")
     */
    public function updateCountryAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $country = $em->getRepository('AppBundle:Country')
            ->find($id);

        $form = $this->createForm(new CountryType(), $country);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {

                $em->flush();

                $this->addFlash('notice', 'Team ' . $country->getFullTitle() .
                    ' updated');

                return $this->redirectToRoute('team_delete_admin');
            }
        }
        return ['form' => $form->createView()];


    }

    /**
     * @Route("/admin/update/coach/{id}", name="coach_update_admin")
     * @Template("@App/admin/updateForm.html.twig")
     */
    public function updateCoachAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $coach = $em->getRepository('AppBundle:Coach')
            ->find($id);

        $form = $this->createForm(new CoachType(), $coach);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {

                $em->flush();

                $this->addFlash('notice', 'Player ' . $coach->getFirstName() . ' ' . $coach->getLastName() .
                    ' updated');

                return $this->redirectToRoute('team_delete_admin');
            }
        }
        return ['form' => $form->createView()];


    }

    /**
     * @Route("/admin/update/player/{id}", name="player_update_admin")
     * @Template("@App/admin/updateForm.html.twig")
     */
    public function updatePlayerAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $player = $em->getRepository('AppBundle:Player')
            ->find($id);

        $form = $this->createForm(new PlayerType(), $player);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {

                $em->flush();

                $this->addFlash('notice', 'Player ' . $player->getFirstName() . ' ' . $player->getLastName() .
                    ' updated');

                return $this->redirectToRoute('team_delete_admin');
            }
        }
        return ['form' => $form->createView()];


    }


    /**
     * @Route("/search/ajax", name="search_show_ajax")
     */
    public function findAjax(Request $request)
    {
        $data = $request->request->get('text');

        $em = $this->getDoctrine()->getManager();

        $obj = $em->getRepository('AppBundle:Team')
            ->findAllAjax($data);

        return new JsonResponse(array('data' => $obj));

    }

    /**
     * @Route("/search/", name="search_show")
     * @Template("@App/admin/searchForm.html.twig")
     */
    public function findData(Request $request)
    {
        $err = '';
        $data = $request->request->get('data');

        $em = $this->getDoctrine()->getManager();

        $obj = $em->getRepository('AppBundle:Team')
            ->findAllAjax($data);

        if (!$obj) {
            $err = 'ERROR: Not found!!!';
        }

        return ['data' => $obj, 'err' => $err];

    }


}
