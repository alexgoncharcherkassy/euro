<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 18.11.15
 * Time: 19:09
 */
namespace AppBundle\Controller;

use AppBundle\Model\Coach;
use AppBundle\Model\Country;
use AppBundle\Model\Match;
use AppBundle\Model\Player;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class EuroController
 * @package AppBundle\Controller
 */
class EuroController extends Controller
{
    /**
     * @Route("/{team}", name = "euro_show_team", requirements={"team" : "\d+"})
     * @Template("@App/euro/showTeam.htm.twig")
     */
    public function showTeamAction($team)
    {
        $player = new Player();
        $player->faker(11);

        $coach = new Coach();
        $coach->faker(1);

        $country = new Country();
        $country->faker();

        return ['players' => $player, 'coaches' => $coach, 'country' => $country];
    }

    /**
     * @Route("/{team}/description", name="euro_show_country", requirements={"team" : "\d+"})
     * @Template("@App/euro/showCountry.html.twig")
     */
    public function showCountryAction($team)
    {
        $country = new Country();
        $country->faker();

        return ['country' => $country];

    }

    /**
     * @Route("/players/{player}", name = "euro_show_player")
     * @Template("@App/euro/showPlayer.html.twig")
     */
    public function showPlayerAction($player)
    {
        $players = new Player();
        $players->faker(1);

        return ['players' => $players];
    }

    /**
     * @Route("/coaches/{coach}", name = "euro_show_coach", requirements={"team" : "\d+"})
     * @Template("@App/euro/showCoach.html.twig")
     */
    public function showCoachAction($coach)
    {
        $coaches = new Coach();
        $coaches->faker(1);

        return ['coaches' => $coaches];
    }

    /**
     * @param $match
     * @Route("/matches/{match}", name="euro_show_match", requirements={"match" : "\d+"})
     * @Template("@App/euro/showMatch.html.twig")
     */
    public function showMatchAction($match)
    {
        $matches = new Match();
        $matches->faker(20);

        return ['matches' => $matches];
    }
}
