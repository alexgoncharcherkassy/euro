<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Country;

/**
 * Team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TeamRepository")
 */
class Team
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
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=100, unique=true)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="groups", type="string", length=10)
     */
    private $groups;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Country", mappedBy="team")
     */
    private $countries;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Coach", mappedBy="team")
     */
    private $coaches;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Player", mappedBy="team")
     */
    private $players;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\ResultGame", mappedBy="team")
     */
    private $results;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Game", mappedBy="team1")
     */
    private $gameTeam1;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Game", mappedBy="team2")
     */
    private $gameTeam2;

    /**
     *
     */
    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->coaches = new ArrayCollection();
        $this->gameTeam1 = new ArrayCollection();
        $this->gameTeam2 = new ArrayCollection();
    }

    /**
     * @param Player $player
     */
    public function addPlayer(Player $player)
    {
        $this->players[] = $player;
    }

    /**
     *
     * @param Player $player
     */
    public function removePlayer(Player $player)
    {
        $this->players->removeElement($player);
    }

    /**
     * @param Coach $coach
     */
    public function addCoach(Coach $coach)
    {
        $this->coaches[] = $coach;
    }

    /**
     * @param Coach $coach
     */
    public function removeCoach(Coach $coach)
    {
        $this->coaches->removeElement($coach);
    }

    /**
     * @param Country $country
     */
    public function addCountry(Country $country)
    {
        $this->countries[] = $country;
    }

    /**
     * @param Country $country
     */
    public function removeCountry(Country $country)
    {
        $this->countries->removeElement($country);
    }

    /**
     * @param ResultGame $resultGame
     */
    public function addResult(ResultGame $resultGame)
    {
        $this->results[] = $resultGame;
    }

    /**
     * @param ResultGame $resultGame
     */
    public function removeResult(ResultGame $resultGame)
    {
        $this->results->removeElement($resultGame);
    }

    /**
     * @param Game $game
     */
    public function addGameTeam1(Game $game)
    {
        $this->gameTeam1[] = $game;
    }

    /**
     * @param Game $game
     */
    public function removeGameTeam1(Game $game)
    {
        $this->gameTeam1->removeElement($game);
    }

    /**
     * @param Game $game
     */
    public function addGameTeam2(Game $game)
    {
        $this->gameTeam2[] = $game;
    }

    /**
     * @param Game $game
     */
    public function removeGameTeam2(Game $game)
    {
        $this->gameTeam2->removeElement($game);
    }

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
     * Set country
     *
     * @param string $country
     *
     * @return Team
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set groups
     *
     * @param string $groups
     *
     * @return Team
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;

        return $this;
    }

    /**
     * Get groups
     *
     * @return string
     */
    public function getGroups()
    {
        return $this->groups;
    }


}

