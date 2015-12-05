<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 05.12.15
 * Time: 12:26
 */

namespace AppBundle\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GameTest extends WebTestCase
{
    public function testShowAll()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/games');
        $this->assertContains('Games', $crawler->filter('body')->text());

    }

    public function testShow()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/games/1');
        $this->assertContains('Games', $crawler->filter('body')->text());

    }

}

