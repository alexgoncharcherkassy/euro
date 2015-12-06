<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CountryController extends Controller
{
    /**
     * @Route("/{id}/description", name="country_show", requirements={"id" : "\d+"})
     * @Template("AppBundle:country:show.html.twig")
     */
    public function showAction($id)
    {
        $country = $this->getDoctrine()->getRepository('AppBundle:Country')
            ->findBy(array('team' => $id));

        if (!$country) {
            throw $this->createNotFoundException(
                'Not found');
        }

        return ['countries' => $country];
    }
}
