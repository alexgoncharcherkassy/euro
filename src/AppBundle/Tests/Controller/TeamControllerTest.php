<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 05.12.15
 * Time: 12:27
 */

namespace AppBundle\Tests\Controller;



use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TeamTest extends WebTestCase
{
    public function testShow()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/14');
        $this->assertContains('Country:', $crawler->filter('body')->text());
    }

}

