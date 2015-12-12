<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Team;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Class DefaultController
 * @package AppBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template("AppBundle:default:index.html.twig")
     *
     */
    public function indexAction()
    {
        $sql = $this->getDoctrine()->getRepository('AppBundle:Team')
            ->showTeamResult();

        $paginator = $this->get('knp_paginator');

        $teams = $paginator->paginate(
            $sql,
            $this->get('request')->query->get('page', 1),
            $this->container->getParameter('knp_paginator.page_range')
        );


        if (!$teams) {
            throw $this->createNotFoundException(
                'Not found');
        }

        return ['teams' => $teams];
    }

}
