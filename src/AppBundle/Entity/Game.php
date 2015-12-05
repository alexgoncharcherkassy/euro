<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GameRepository")
 */
class Game
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
     * @ORM\Column(name="team1", type="string", length=100)
     *
     */
    private $team1;

    /**
     * @var int
     *
     * @ORM\Column(name="team2", type="string", length=100)
     */
    private $team2;

    /**
     * @var int
     *
     * @ORM\Column(name="goals1", type="integer")
     */
    private $goals1;

    /**
     * @var int
     *
     * @ORM\Column(name="goals2", type="integer")
     */
    private $goals2;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateGame", type="datetime")
     */
    private $dateGame;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Team", inversedBy="gameTeam1")
     */
    private $team1Id;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Team", inversedBy="gameTeam2")
     */
    private $team2Id;


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
     * Set team1
     *
     * @param integer $team1
     *
     * @return Game
     */
    public function setTeam1($team1)
    {
        $this->team1 = $team1;

        return $this;
    }

    /**
     * Get team1
     *
     * @return int
     */
    public function getTeam1()
    {
        return $this->team1;
    }

    /**
     * Set team2
     *
     * @param integer $team2
     *
     * @return Game
     */
    public function setTeam2($team2)
    {
        $this->team2 = $team2;

        return $this;
    }

    /**
     * Get team2
     *
     * @return int
     */
    public function getTeam2()
    {
        return $this->team2;
    }

    /**
     * Set goals1
     *
     * @param integer $goals1
     *
     * @return Game
     */
    public function setGoals1($goals1)
    {
        $this->goals1 = $goals1;

        return $this;
    }

    /**
     * Get goals1
     *
     * @return int
     */
    public function getGoals1()
    {
        return $this->goals1;
    }

    /**
     * Set goals2
     *
     * @param integer $goals2
     *
     * @return Game
     */
    public function setGoals2($goals2)
    {
        $this->goals2 = $goals2;

        return $this;
    }

    /**
     * Get goals2
     *
     * @return int
     */
    public function getGoals2()
    {
        return $this->goals2;
    }

    /**
     * Set dateGame
     *
     * @param \DateTime $dateGame
     *
     * @return Game
     */
    public function setDateGame($dateGame)
    {
        $this->dateGame = $dateGame;

        return $this;
    }

    /**
     * Get dateGame
     *
     * @return \DateTime
     */
    public function getDateGame()
    {
        return $this->dateGame;
    }

    public function getTeam1Id()
    {
        return $this->team1Id;
    }

    public function getTeam2Id()
    {
        return $this->team2Id;
    }

    public function setTeam1Id(\AppBundle\Entity\Team $team1Id = null)
    {
        $this->team1Id = $team1Id;

        return $this;
    }

    public function setTeam2Id(\AppBundle\Entity\Team $team2Id = null)
    {
        $this->team2Id = $team2Id;

        return $this;
    }
}
