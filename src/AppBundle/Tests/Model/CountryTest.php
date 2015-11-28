<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 28.11.15
 * Time: 12:40
 */

namespace AppBundle\Tests\Model;


use AppBundle\Model\Country;

class CountryTest extends \PHPUnit_Framework_TestCase
{
    public function testFaker()
    {
        $country = new Country();
        $country->faker();

        $this->assertCount(1, $country->getCountry());
        $this->assertCount(1, $country->getDescription());
    }

}

