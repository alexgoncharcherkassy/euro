<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 05.12.15
 * Time: 12:27
 */

namespace AppBundle\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Tests\Functional\WebTestCase;

class TeamTest extends WebTestCase
{
    public function testShow()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/1');
        $this->assertContains('Country:', $crawler->filter('body')->text());
    }

}

