<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 20.11.15
 * Time: 18:41
 */

namespace AppBundle\Tests\Controller;


use AppBundle\Tests\TestBaseWeb;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends TestBaseWeb
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Standings', $crawler->filter('body')->text());
    }

}


