<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 17.12.15
 * Time: 18:30
 */

namespace AppBundle\Model;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BuilerChoise extends Controller
{
    public function buildChoises()
    {
        $choises = [];

        $objAll = $this->getDoctrine()->getManager()
        ->getRepository('AppBundle:Team')
            ->findAll();

        foreach ($objAll as $obj) {
            $choises[$obj->getId()] = $obj->getCountry();
        }

        return $choises;
    }

}