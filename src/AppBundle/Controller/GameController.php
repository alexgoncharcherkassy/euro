<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class GameController extends Controller
{
    /**
     * @Route("/games", name="game_show_all")
     * @Template("AppBundle:game:showAll.html.twig")
     */
    public function showAllAction()
    {

        $games = $this->getDoctrine()
            ->getRepository('AppBundle:Game')
            ->showAllGame();

        if (!$games) {
            throw $this->createNotFoundException(
                'Not found');
        }

        return ['games' => $games];
    }

    /**
     * @Route("/games/{id}", name="game_show_id", requirements={"id" : "\d+"})
     * @Template("AppBundle:game:show.html.twig")
     */
    public function showAction($id)
    {
        $games = $this->getDoctrine()
            ->getRepository('AppBundle:Game')
            ->showGame($id);

        if (!$games) {
            throw $this->createNotFoundException(
                'Not found');
        }

        return ['games' => $games];
    }
}
