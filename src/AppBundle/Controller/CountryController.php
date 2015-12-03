<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CountryController extends Controller
{
    /**
     * @Route("/{team}/description", name="country_show", requirements={"team" : "\d+"})
     * @Template("AppBundle:country:show.html.twig")
     */
    public function showAction($team)
    {


        return [];

    }
}
