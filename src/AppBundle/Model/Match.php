<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 27.11.15
 * Time: 16:38
 */

namespace AppBundle\Model;

use Faker;


/**
 * Class Match
 * @package AppBundle\Model
 */
class Match
{

    protected $team1 = array();

    protected $team2 = array();

    protected $goals1 = array();

    protected $goals2 = array();

    protected $dateMatch = array();

    /**
     * @return mixed
     */
    public function getTeam1()
    {
        return $this->team1;
    }

    /**
     * @param mixed $team1
     */
    public function setTeam1($team1)
    {
        $this->team1 = $team1;
    }

    /**
     * @return mixed
     */
    public function getTeam2()
    {
        return $this->team2;
    }

    /**
     * @param mixed $team2
     */
    public function setTeam2($team2)
    {
        $this->team2 = $team2;
    }

    /**
     * @return mixed
     */
    public function getGoals1()
    {
        return $this->goals1;
    }

    /**
     * @param mixed $goals1
     */
    public function setGoals1($goals1)
    {
        $this->goals1 = $goals1;
    }

    /**
     * @return mixed
     */
    public function getGoals2()
    {
        return $this->goals2;
    }

    /**
     * @param mixed $goals2
     */
    public function setGoals2($goals2)
    {
        $this->goals2 = $goals2;
    }

    /**
     * @return array
     */
    public function getDateMatch()
    {
        return $this->dateMatch;
    }

    /**
     * @param array $dateMatch
     */
    public function setDateMatch($dateMatch)
    {
        $this->dateMatch = $dateMatch;
    }

    /**
     *
     */
    public function faker($counts)
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < $counts; $i++) {
            $this->team1[$i] = $faker->country;
            $this->team2[$i] = $faker->country;
            $this->goals1[$i] = rand(0, 5);
            $this->goals2[$i] = rand(0, 5);
            $this->dateMatch[$i] = $faker->dateTime;
        }
    }

}