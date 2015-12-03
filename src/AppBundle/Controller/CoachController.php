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
     * @Route("/coaches/{coach}", name = "coach_show", requirements={"coach" : "\d+"})
     * @Template("AppBundle:coach:show.html.twig")
     */
    public function showAction($coach)
    {


        return [];
    }

}
