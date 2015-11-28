<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 28.11.15
 * Time: 12:46
 */

namespace AppBundle\Tests\Model;


use AppBundle\Model\Player;

class PlayerTest extends \PHPUnit_Framework_TestCase
{
    public function testFaker()
    {
        $player = new Player();
        $player->faker(11);

        $this->assertCount(11, $player->getBiography());
        $this->assertCount(11, $player->getBirthDay());
        $this->assertCount(11, $player->getFirstName());
        $this->assertCount(11, $player->getLastName());
    }

}

