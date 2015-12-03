<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ResultGame
 *
 * @ORM\Table(name="result_game")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ResultGameRepository")
 */
class ResultGame
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="countGame", type="integer")
     */
    private $countGame;

    /**
     * @var int
     *
     * @ORM\Column(name="winGame", type="integer")
     */
    private $winGame;

    /**
     * @var string
     *
     * @ORM\Column(name="drawGame", type="integer")
     */
    private $drawGame;

    /**
     * @var int
     *
     * @ORM\Column(name="defeatGame", type="integer")
     */
    private $defeatGame;

    /**
     * @var int
     *
     * @ORM\Column(name="points", type="integer")
     */
    private $points;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Team", inversedBy="results")
     */
    private $team;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set countGame
     *
     * @param integer $countGame
     *
     * @return ResultGame
     */
    public function setCountGame($countGame)
    {
        $this->countGame = $countGame;

        return $this;
    }

    /**
     * Get countGame
     *
     * @return int
     */
    public function getCountGame()
    {
        return $this->countGame;
    }

    /**
     * Set winGame
     *
     * @param integer $winGame
     *
     * @return ResultGame
     */
    public function setWinGame($winGame)
    {
        $this->winGame = $winGame;

        return $this;
    }

    /**
     * Get winGame
     *
     * @return int
     */
    public function getWinGame()
    {
        return $this->winGame;
    }

    /**
     * Set drawGame
     *
     * @param string $drawGame
     *
     * @return ResultGame
     */
    public function setDrawGame($drawGame)
    {
        $this->drawGame = $drawGame;

        return $this;
    }

    /**
     * Get drawGame
     *
     * @return string
     */
    public function getDrawGame()
    {
        return $this->drawGame;
    }

    /**
     * Set defeatGame
     *
     * @param integer $defeatGame
     *
     * @return ResultGame
     */
    public function setDefeatGame($defeatGame)
    {
        $this->defeatGame = $defeatGame;

        return $this;
    }

    /**
     * Get defeatGame
     *
     * @return int
     */
    public function getDefeatGame()
    {
        return $this->defeatGame;
    }

    /**
     * Set points
     *
     * @param integer $points
     *
     * @return ResultGame
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set team
     *
     * @param \AppBundle\Entity\Team $team
     *
     * @return ResultGame
     */
    public function setTeam(\AppBundle\Entity\Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \AppBundle\Entity\Team
     */
    public function getTeam()
    {
        return $this->team;
    }
}
