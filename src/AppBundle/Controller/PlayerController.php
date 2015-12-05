<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Faker\Factory;
use AppBundle\Entity\Player;
use Symfony\Component\HttpFoundation\Response;

class PlayerController extends Controller
{
    /**
     * @Route("/players/{id}", name = "player_show", requirements={"id" : "\d+"})
     * @Template("AppBundle:player:show.html.twig")
     */
    public function showAction($id)
    {
        $players = $this->getDoctrine()
            ->getRepository('AppBundle:Player')
            ->find($id);

        if (!$players) {
            throw $this->createNotFoundException(
                'Not found');
        }

        return ['players' => $players];
    }

}
