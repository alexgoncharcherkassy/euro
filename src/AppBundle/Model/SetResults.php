<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 16.12.15
 * Time: 19:35
 */

namespace AppBundle\Model;


use AppBundle\Entity\ResultGame;
use AppBundle\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SetResults extends Controller
{
    public function setStartResult(Team $team)
    {
        $results = new ResultGame();

        $results->setCountGame(0);
        $results->setWinGame(0);
        $results->setDrawGame(0);
        $results->setDefeatGame(0);
        $results->setPoints(0);
        $results->setTeam($team);

        return $results;
    }

    public function setGameResults(Team $team1, $goals1, Team $team2, $goals2)
    {
        $result1 = new ResultGame();
        $result2 = new ResultGame();

        if ($goals1 > $goals2) {

        }

    }

}