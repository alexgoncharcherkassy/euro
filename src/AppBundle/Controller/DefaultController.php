<?php

namespace AppBundle\Controller;

use AppBundle\Model\Result;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Model\Team;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template("AppBundle:default:index.html.twig")
     *
     */
    public function indexAction()
    {
        $team = new Team();
        $team->faker(11);

        $result = new Result();
        $result->faker(11);

        return ['teams' => $team, 'result' => $result];
    }
}
