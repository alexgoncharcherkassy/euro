<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 28.11.15
 * Time: 12:47
 */

namespace AppBundle\Tests\Model;


use AppBundle\Model\Result;

class ResultTest extends \PHPUnit_Framework_TestCase
{
    public function testFaker()
    {
        $result = new Result();
        $result->faker(11);

        $this->assertCount(11, $result->getCountGame());
        $this->assertCount(11, $result->getDefeatGame());
        $this->assertCount(11, $result->getDrawGame());
        $this->assertCount(11, $result->getPoints());
        $this->assertCount(11, $result->getWinGame());
    }

}
