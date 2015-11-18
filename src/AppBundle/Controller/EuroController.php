<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 18.11.15
 * Time: 19:09
 */
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class EuroController
 * @package AppBundle\Controller
 */
class EuroController extends Controller
{
    /**
     * @Route("/{team}", name = "euro_show_team")
     */
    public function showTeamAction($team)
    {
        $arr = array();
        if ($team == 1) {
            $arr =array(1=> ['id' => '1', 'country' => 'Ukraine', 'group' => 'A']);
        }

        return $this->render("AppBundle::showteam.html.twig", array('teams' => $arr));
    }

    /**
     * @Route("/{team}/description", name="euro_show_country")
     */
    public function showCountryAction($team)
    {
        $country = '';
        if ($team == 1) {
            $country = 'This is my country';
        }

        return $this->render("AppBundle::showcountry.html.twig", array('country' => $country));
    }

    /**
     * @Route("/players/{player}", name = "euro_show_player")
     */
    public function showPlayerAction($player)
    {
        $players = '';
        if ($player == 1) {
            $players = 'Biography player 1';
        }

        return $this->render("AppBundle::showplayer.html.twig", array('players' => $players));
    }

    /**
     * @Route("/coaches/{coach}", name = "euro_show_coach")
     */
    public function showCoachAction($coach)
    {
        $coaches = '';
        if ($coach == 1) {
            $coaches = 'Biography coach 1';
        }

        return $this->render("AppBundle::showcoach.html.twig", array('coaches' => $coaches));
    }
}
