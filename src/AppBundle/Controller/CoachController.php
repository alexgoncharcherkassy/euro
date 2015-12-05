<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class CoachController
 * @package AppBundle\Controller
 */
class CoachController extends Controller
{
    /**
     * @Route("/coaches/{id}", name = "coach_show", requirements={"id" : "\d+"})
     * @Template("AppBundle:coach:show.html.twig")
     */
    public function showAction($id)
    {
        $coach = $this->getDoctrine()->getRepository('AppBundle:Coach')
            ->find($id);

        if (!$coach) {
            throw $this->createNotFoundException(
                'Not found');
        }

        return ['coaches' => $coach];
    }

}
