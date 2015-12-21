<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 05.12.15
 * Time: 12:26
 */

namespace AppBundle\Tests\Controller;


use AppBundle\Tests\TestBaseWeb;

class GameTest extends TestBaseWeb
{
    public function testShowAll()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/games/page/1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Games', $crawler->filter('body')->text());

    }

    public function testShow()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/games/1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Games', $crawler->filter('body')->text());

    }

}

