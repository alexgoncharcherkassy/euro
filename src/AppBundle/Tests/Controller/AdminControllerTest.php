<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 05.12.15
 * Time: 12:15
 */

namespace AppBundle\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    public function testShow()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin');
        $this->assertContains('Not found', $crawler->filter('body')->text());

    }

}

