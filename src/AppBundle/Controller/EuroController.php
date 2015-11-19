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
use Symfony\Component\HttpFoundation\Response;

/**
 * Class EuroController
 * @package AppBundle\Controller
 */
class EuroController extends Controller
{
    /**
     * @Route("/{team}", name = "euro_show_team", requirements={"team" : "\d+"})
     */
    public function showTeamAction($team)
    {
        switch ($team) {
            case 1 :
                $teams = '<a href="1/description">Spain</a><br/>Coach: <a href="coaches/1">Vicente del Bosque</a>';
                break;
            case 2 :
                $teams = '<a href="2/description">Slovakia</a><br/>Coach: <a href="coaches/2">Ján Kozák</a>';
                break;
            case 3 :
                $teams = '<a href="3/description">Ukraine</a><br/>Coach: <a href="coaches/3">Mykhaylo Fomenko</a>';
                break;
            case 4 :
                $teams = '<a href="4/description">Belarus</a><br/>Coach: <a href="coaches/4">Alyaksandr Khatskevich</a>';
                break;
            case 5 :
                $teams = '<a href="5/description">Macedonia</a><br/>Coach: <a href="coaches/5">Igor Angelovski</a>';
                break;
            case 6 :
                $teams = '<a href="6/description">Luxembourg</a><br/>Coach: <a href="coaches/6">Luc Holtz</a>';
                break;
            default :
                throw $this->createNotFoundException('Not found');
        }

        return new Response($teams);
    }

    /**
     * @Route("/{team}/description", name="euro_show_country", requirements={"team" : "\d+"})
     */
    public function showCountryAction($team)
    {
        switch ($team) {
            case 1 :
                $country = '<a href="https://en.wikipedia.org/wiki/Spain_national_football_team">WIKI</a>';
                break;
            case 2 :
                $country = '<a href="https://en.wikipedia.org/wiki/Slovakia_national_football_team">WIKI</a>';
                break;
            case 3 :
                $country = '<a href="https://en.wikipedia.org/wiki/Ukraine_national_football_team">WIKI</a>';
                break;
            case 4 :
                $country = '<a href="https://en.wikipedia.org/wiki/Belarus_national_football_team">WIKI</a>';
                break;
            case 5 :
                $country = '<a href="https://en.wikipedia.org/wiki/Macedonia_national_football_team">WIKI</a>';
                break;
            case 6 :
                $country = '<a href="https://en.wikipedia.org/wiki/Luxembourg_national_football_team">WIKI</a>';
                break;
            default :
                throw $this->createNotFoundException('Not found');
        }

        return new Response($country);
    }

    /**
     * @Route("/coaches/{coach}", name = "euro_show_coach", requirements={"team" : "\d+"})
     */
    public function showCoachAction($coach)
    {
        switch ($coach) {
            case 1 :
                $coaches = $this->redirect('https://en.wikipedia.org/wiki/Vicente_del_Bosque');
                break;
            case 2 :
                $coaches = $this->redirect('https://en.wikipedia.org/wiki/J%C3%A1n_Koz%C3%A1k_%28footballer,_born_1954%29');
                break;
            case 3 :
                $coaches = $this->redirect('https://en.wikipedia.org/wiki/Mykhaylo_Fomenko');
                break;
            case 4 :
                $coaches = $this->redirect('https://en.wikipedia.org/wiki/Alyaksandr_Khatskevich');
                break;
            case 5 :
                $coaches = $this->redirect('https://en.wikipedia.org/wiki/Igor_Angelovski');
                break;
            case 6 :
                $coaches = $this->redirect('https://en.wikipedia.org/wiki/Luc_Holtz');
                break;
            default :
                throw $this->createNotFoundException('Not found');
        }

        return new Response($coaches);
    }
}
