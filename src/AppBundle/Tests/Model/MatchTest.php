<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 28.11.15
 * Time: 12:49
 */

namespace AppBundle\Tests\Model;


use AppBundle\Model\Match;

class MatchTest extends \PHPUnit_Framework_TestCase
{
    public function testFaker()
    {
        $match = new Match();
        $match->faker(10);

        $this->assertCount(10, $match->getTeam1());
        $this->assertCount(10, $match->getTeam2());
        $this->assertCount(10, $match->getGoals1());
        $this->assertCount(10, $match->getGoals2());
        $this->assertCount(10, $match->getDateMatch());
    }

}

