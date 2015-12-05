<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 05.12.15
 * Time: 12:26
 */

namespace AppBundle\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Tests\Functional\WebTestCase;

class PlayerTest extends WebTestCase
{
    public function testShow()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/players/1');
        $this->assertContains('Player:', $crawler->filter('body')->text());

    }

}
