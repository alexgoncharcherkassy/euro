<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GameController
 * @package AppBundle\Controller
 */
class GameController extends Controller
{
    /**
     * @Route("/games", name="game_show_all")
     * @Template("AppBundle:game:showAll.html.twig")
     */
    public function showAllAction()
    {
        $em = $this->getDoctrine()->getRepository('AppBundle:Game');
        $games = $em->showAllGameAjax(1, 10);

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
        $sql = $this->getDoctrine()
            ->getRepository('AppBundle:Game')
            ->showGame($id);

        $paginator = $this->get('knp_paginator');

        $games = $paginator->paginate(
            $sql,
            $this->get('request')->query->get('page', 1),
            $this->container->getParameter('knp_paginator.page_range')
        );


        if (!$games) {
            throw $this->createNotFoundException(
                'Not found');
        }

        return ['games' => $games];
    }

    /**
     * @Route("/games/ajax/", name="game_show_ajax", options={"expose" = true})
     */
    public function showAjaxAction()
    {
        $em = $this->getDoctrine()->getRepository('AppBundle:Game');

        static $page = 2;

        $limit = 10;
        $start = $page * $limit - $limit;

        $objects = $em->showAllGameAjax($start, $limit);
        if ($objects) {
            $page++;
        }
        
        return new JsonResponse(array('games' => $objects));

    }

    /**
     * @Route("/games/all", name="game_show_paginator", requirements={"page" : "\d+"})
     * @Template("AppBundle:game:showAll.html.twig")
     */
    public function showPaginate()
    {
        $sql = $this->getDoctrine()->getRepository('AppBundle:Game')
            ->showAllGame();

        $paginator = $this->get('knp_paginator');

        $games = $paginator->paginate(
            $sql,
            $this->get('request')->query->get('page', 1),
            $this->container->getParameter('knp_paginator.page_range')
        );

        return ['games' => $games];

    }
}
