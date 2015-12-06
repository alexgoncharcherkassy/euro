<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 04.12.15
 * Time: 17:11
 */

namespace AppBundle\Model;


use AppBundle\Entity\ResultGame;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class Points extends Controller
{
    public function writeResult($team, $point1, $point2)
    {
        $result = new ResultGame();
        $point = $this->checkGoals($point1, $point2);
        $data = $this->getDoctrine()->getRepository('AppBundle:ResultGame')
            ->findOneBy(array('team' => $team));

        if ($data) {
            $count = $data->getCountGame();
            $win = $data->getWinGame();
            $draw = $data->getDrawGame();
            $defeat = $data->getDefeatGame();

        } else {
            $count = 0;
            $win = 0;
            $draw = 0;
            $defeat = 0;
        }



        switch ($point) {
            case 0 :
                $defeat += 1;
                $count += 1;
                break;
            case 1 :
                $draw += 1;
                $count += 1;
                break;
            case 3 :
                $win += 1;
                $count += 1;
                break;
        }
        $points = $draw + 3 * $win;

        $em = $this->getDoctrine()->getManager();

        $result->setCountGame($count);
        $result->setWinGame($win);
        $result->setDrawGame($draw);
        $result->setDefeatGame($defeat);
        $result->setPoints($points);
        $result->setTeam($team);
        $em->persist($result);
        $em->flush();

        return;

    }

    public function checkGoals($goals1, $goals2)
    {
        if ($goals1 > $goals2) {
            $points = 3;
        } elseif ($goals1 < $goals2) {
            $points = 0;
        } else {
            $points = 1;
        }
        return $points;
    }

}