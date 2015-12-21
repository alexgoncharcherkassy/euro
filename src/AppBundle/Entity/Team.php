<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="country", type="string", length=100)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="groups", type="string", length=10)
     */
    private $groups;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Country", mappedBy="team", cascade={"persist"})
     */
    private $countries;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Coach", mappedBy="team", cascade={"persist"})
     */
    private $coaches;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Player", mappedBy="team", cascade={"persist"})
     */
    private $players;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\ResultGame", mappedBy="team", cascade={"persist"})
     */
    private $results;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Game", mappedBy="team1", cascade={"persist"})
     */
    private $gameTeam1;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Game", mappedBy="team2", cascade={"persist"})
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
        $player->setTeam($this);
        $this->players[] = $player;

        return $this;
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
        $coach->setTeam($this);
        $this->coaches[] = $coach;

        return $this;
    }

    /**
     * @param Coach $coach
     */
    public function removeCoach(Coach $coach)
    {
        $this->coaches->removeElement($coach);
    }
/*


    /**
     * @param Game $game
     */
    /**
     * @param Game $game
     */
    public function addGameTeam1(Game $game)
    {
        $game->setTeam1Id($this);
        $this->gameTeam1[] = $game;

        return $this;
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
        $game->setTeam2Id($this);
        $this->gameTeam2[] = $game;

        return $this;
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

    /**
     * @return mixed
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @return ArrayCollection
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * @return mixed
     */
    public function getCountries()
    {
        return $this->countries;
    }

    /**
     * @return ArrayCollection
     */
    public function getCoaches()
    {
        return $this->coaches;
    }

    /**
     * @return ArrayCollection
     */
    public function getGameTeam1()
    {
        return $this->gameTeam1;
    }

    /**
     * @return ArrayCollection
     */
    public function getGameTeam2()
    {
        return $this->gameTeam2;
    }


}

