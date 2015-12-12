<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 05.12.15
 * Time: 12:25
 */

namespace AppBundle\Tests\Controller;


use AppBundle\Tests\TestBaseWeb;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CountryTest extends TestBaseWeb
{
    public function testShow()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/1/description');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Country:', $crawler->filter('body')->text());
    }

}

