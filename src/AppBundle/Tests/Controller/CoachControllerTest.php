<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 05.12.15
 * Time: 12:24
 */

namespace AppBundle\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Tests\Functional\WebTestCase;

class CoachTest extends WebTestCase
{
    public function testShow()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/coaches/1');
        $this->assertContains('Coach:', $crawler->filter('body')->text());

    }

}

