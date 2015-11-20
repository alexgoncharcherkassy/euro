<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 20.11.15
 * Time: 18:41
 */

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test;


class DefaultControllerTest extends Test\WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('EURO 2016', $crawler->filter('h1')->text());
    }

}

