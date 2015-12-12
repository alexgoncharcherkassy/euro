<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 05.12.15
 * Time: 12:15
 */

namespace AppBundle\Tests\Controller;


use AppBundle\Tests\TestBaseWeb;
//use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends TestBaseWeb
{
    public function testShow()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Admin', $crawler->filter('body')->text());

    }

}

