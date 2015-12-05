<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TeamController extends Controller
{
    /**
     * @Route("/{id}", name = "team_show", requirements={"id" : "\d+"})
     * @Template("AppBundle:team:show.html.twig")
     */
    public function showAction($id)
    {
        $players = $this->getDoctrine()
            ->getRepository('AppBundle:Player')
            ->findBy(array('team' => $id));

        $coaches = $this->getDoctrine()
            ->getRepository('AppBundle:Coach')
            ->findBy(array('team' => $id));

        $countries = $this->getDoctrine()
            ->getRepository('AppBundle:Country')
            ->findBy(array('team' => $id));

        $games = $id;

        if (!$players) {
            throw $this->createNotFoundException(
                'Not found');
        }

        return ['players' => $players, 'coaches' => $coaches, 'countries' => $countries, 'games' => $games];
    }
}
