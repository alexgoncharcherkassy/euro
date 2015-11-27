<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 27.11.15
 * Time: 16:43
 */

namespace AppBundle\Model;


/**
 * Class Result
 * @package AppBundle\Model
 */
class Result
{
    /**
     * @var array
     */
    protected $countGame = array();
    /**
     * @var array
     */
    protected $winGame = array();
    /**
     * @var array
     */
    protected $drawGame = array();
    /**
     * @var array
     */
    protected $defeatGame = array();
    /**
     * @var array
     */
    protected $points = array();

    /**
     * @return array
     */
    public function getCountGame()
    {
        return $this->countGame;
    }

    /**
     * @param array $countGame
     */
    public function setCountGame($countGame)
    {
        $this->countGame = $countGame;
    }

    /**
     * @return array
     */
    public function getWinGame()
    {
        return $this->winGame;
    }

    /**
     * @param array $winGame
     */
    public function setWinGame($winGame)
    {
        $this->winGame = $winGame;
    }

    /**
     * @return array
     */
    public function getDrawGame()
    {
        return $this->drawGame;
    }

    /**
     * @param array $drawGame
     */
    public function setDrawGame($drawGame)
    {
        $this->drawGame = $drawGame;
    }

    /**
     * @return array
     */
    public function getDefeatGame()
    {
        return $this->defeatGame;
    }

    /**
     * @param array $defeatGame
     */
    public function setDefeatGame($defeatGame)
    {
        $this->defeatGame = $defeatGame;
    }

    /**
     * @return array
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param array $points
     */
    public function setPoints($points)
    {
        $this->points = $points;
    }

    /**
     * @param $counts
     */
    public function faker($counts)
    {
        for ($i = 0; $i < $counts; $i++) {
            $this->countGame[$i] = rand(1, 15);
            $this->winGame[$i] = rand(0, 15);
            $this->drawGame[$i] = rand(0, 15);
            $this->defeatGame[$i] = rand(0, 15);
            $this->points[$i] = rand(0, 30);
        }
    }

}