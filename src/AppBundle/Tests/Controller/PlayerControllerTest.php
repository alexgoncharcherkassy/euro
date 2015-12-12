<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 05.12.15
 * Time: 12:26
 */

namespace AppBundle\Tests\Controller;

use AppBundle\Tests\TestBaseWeb;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PlayerTest extends TestBaseWeb
{
    public function testShow()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/players/1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Player:', $crawler->filter('body')->text());

    }

}
