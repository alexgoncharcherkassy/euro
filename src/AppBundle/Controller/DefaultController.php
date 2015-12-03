<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Team;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Faker\Factory;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template("AppBundle:default:index.html.twig")
     *
     */
    public function indexAction()
    {
        $teams = $this->getDoctrine()
            ->getRepository('AppBundle:Team')
            ->findAll();

        if (!$teams) {
            throw $this->createNotFoundException(
                'Not found');
        }

        return ['teams' => $teams];
    }

}
