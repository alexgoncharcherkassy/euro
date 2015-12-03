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
        $teams = $this->getDoctrine()
            ->getRepository('AppBundle:Team')
            ->findBy(array('team' => $id));

        if (!$teams) {
            throw $this->createNotFoundException(
                'Not found');
        }

        return ['teams' => $teams];
    }
}
