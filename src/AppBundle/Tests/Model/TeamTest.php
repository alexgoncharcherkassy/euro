<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 28.11.15
 * Time: 12:35
 */

namespace AppBundle\Tests\Model;


use AppBundle\Model\Team;

class TeamTest extends \PHPUnit_Framework_TestCase
{
    public function testFaker()
    {
        $team = new Team();
        $team->faker(10);

        $this->assertCount(10, $team->getCountry());
        $this->assertCount(10, $team->getGroups());
    }

}

