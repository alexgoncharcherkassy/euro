<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 28.11.15
 * Time: 12:42
 */

namespace AppBundle\Tests\Model;


use AppBundle\Model\Coach;

class CoachTest extends \PHPUnit_Framework_TestCase
{
    public function testFaker()
    {
        $coach = new Coach();
        $coach->faker(1);

        $this->assertCount(1, $coach->getBiography());
        $this->assertCount(1, $coach->getBirthDay());
        $this->assertCount(1, $coach->getFirstName());
        $this->assertCount(1, $coach->getLastName());
    }

}

