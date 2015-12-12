<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class TeamController
 * @package AppBundle\Controller
 */
class TeamController extends Controller
{
    /**
     * @Route("/{id}", name = "team_show", requirements={"id" : "\d+"})
     * @Template("AppBundle:team:show.html.twig")
     */
    public function showAction($id)
    {
        $players = $this->getDoctrine()->getRepository('AppBundle:Team')
            ->showTeamId($id);

        $games = $id;

        if (!$players) {
            throw $this->createNotFoundException(
                'Not found');
        }

        return ['players' => $players, 'games' => $games];
    }
}
